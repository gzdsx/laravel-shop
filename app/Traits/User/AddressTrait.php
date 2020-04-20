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

trait AddressTrait
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $address_id = $request->input('address_id');
        if ($address_id) {
            $address = Auth::user()->addresses()->findOrNew($address_id);
        } else {
            $address = Auth::user()->addresses()->make();
        }
        $address->fill($request->input('address', []))->save();
        return $this->sendAddressSavedResponse($request, $address);
    }

    /**
     * @param Request $request
     * @param $address
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendAddressSavedResponse(Request $request, $address)
    {
        return ajaxReturn(['address' => $address]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function setDefault(Request $request)
    {
        $address_id = $request->input('address_id', 0);
        Auth::user()->addresses()->update(['isdefault'=>0]);
        Auth::user()->addresses()->whereKey($address_id)->update(['isdefault' => 1]);
        return ajaxReturn();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        Auth::user()->addresses()->whereKey($request->input('address_id', 0))->delete();
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $address_id = $request->get('address_id', 0);
        if ($address_id) {
            $address = Auth::user()->addresses()->findOrFail($address_id);
        } else {
            $address = Auth::user()->addresses()->orderByDesc('isdefault')->firstOrFail();
        }

        return ajaxReturn(['address' => $address]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $items = Auth::user()->addresses()->orderByDesc('isdefault')->orderBy('address_id')->get();
        return ajaxReturn(['items' => $items]);
    }
}
