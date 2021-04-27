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
        $address = $this->repository()->findOrNew($request->input('id'));
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
        $this->repository()->update(['isdefault' => 0]);
        $this->repository()->whereKey($request->input('id'))->update(['isdefault' => 1]);
        return jsonSuccess();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('id', 0))->delete();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        if ($id = $request->input('id')) {
            $address = $this->repository()->find($id);
        } else {
            $address = $this->repository()->where('isdefault', 1)->first();
        }

        if ($address) {
            return jsonSuccess(['address' => $address]);
        }

        return jsonError(404, 'address not found');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $items = $this->repository()->orderByDesc('isdefault')->get();
        return jsonSuccess(['items' => $items]);
    }
}
