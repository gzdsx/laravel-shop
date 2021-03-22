<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-23
 * Time: 17:43
 */

namespace App\Traits\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait UserAddressTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function repository()
    {
        return Auth::user()->addresses();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $address_id = $request->input('address_id');
        $address = $this->repository()->findOrNew($address_id);
        $address->fill($request->input('address', []));
        if ($address->isdefault == 1) {
            $this->repository()->update(['isdefault' => 0]);
        }
        $address->save();
        return $this->sendAddressSavedResponse($request, $address);
    }

    /**
     * @param Request $request
     * @param $address
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendAddressSavedResponse(Request $request, $address)
    {
        return jsonSuccess(['address' => $address]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function setDefault(Request $request)
    {
        $address_id = $request->input('address_id', 0);
        $this->repository()->update(['isdefault' => 0]);
        $this->repository()->whereKey($address_id)->update(['isdefault' => 1]);
        return jsonSuccess();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('address_id', 0))->delete();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $address_id = $request->get('address_id', 0);
        if ($address_id) {
            $address = $this->repository()->find($address_id);
        } else {
            $address = $this->repository()->orderByDesc('isdefault')->first();
        }

        return jsonSuccess(['address' => $address]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $items = $this->repository()->orderByDesc('isdefault')->orderBy('address_id')->get();
        return jsonSuccess(['items' => $items]);
    }
}
