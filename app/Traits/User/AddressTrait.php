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


use App\Repositories\Contracts\AddressRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AddressTrait
{

    /**
     * @return AddressRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function addressRepository()
    {
        return app(AddressRepositoryInterface::class);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $address_id = $request->input('address_id');
        if ($address_id) {
            $this->addressRepository()->whereKey($address_id)->update($request->input('address', []));
            $address = $this->addressRepository()->find($address_id);
        } else {
            $address = $this->addressRepository()->create($request->input('address', []));
        }
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
        $this->addressRepository()->where('uid', Auth::id())->update(['isdefault' => 0]);
        $this->addressRepository()->whereKey($address_id)->update(['isdefault' => 1]);
        return ajaxReturn();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $address_id = $request->input('address_id', 0);
        $this->addressRepository()->where('uid', Auth::id())->where('address_id', $address_id)->delete();
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
            $address = $this->addressRepository()->where('uid', Auth::id())->findOrFail($address_id);
        } else {
            $address = $this->addressRepository()->where('uid', Auth::id())->orderByDesc('isdefault')->firstOrFail();
        }

        return ajaxReturn(['address' => $address]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $items = $this->addressRepository()->where('uid', Auth::id())->orderBy('address_id')->get();
        return ajaxReturn(['items' => $items]);
    }
}
