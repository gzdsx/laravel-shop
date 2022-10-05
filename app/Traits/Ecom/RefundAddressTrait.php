<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/1/11
 * Time: 04:33
 */

namespace App\Traits\Ecom;


use App\Models\RefundAddress;
use Illuminate\Http\Request;

trait RefundAddressTrait
{

    /**
     * @return RefundAddress|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return RefundAddress::query();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getInfo(Request $request)
    {
        return ['address' => $this->repository()->find($request->input('id'))];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository();
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $address = $this->repository()->findOrNew($request->input('id'));
        $address->fill($request->input('address', []));
        if ($address->isdefault) {
            $this->repository()->update(['isdefault' => 0]);
        }
        $address->save();
        return jsonSuccess(['address' => $address]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->delete();
        return jsonSuccess();
    }
}
