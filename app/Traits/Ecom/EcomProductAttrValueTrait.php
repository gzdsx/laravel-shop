<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/11/2
 * Time: 14:12
 */

namespace App\Traits\Ecom;


use App\Models\EcomProductAttr;
use App\Models\EcomProductAttrValue;
use Illuminate\Http\Request;

trait EcomProductAttrValueTrait
{
    /**
     * @return EcomProductAttrValue|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return EcomProductAttrValue::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $attr = EcomProductAttr::findOrFail($request->input('attr_cate_id'));
        $attr->load(['attrValues']);

        return jsonSuccess(['attr' => $attr]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $attr_value = $this->repository()->create($request->input('attr_value', []));

        return jsonSuccess(['attr_value' => $attr_value]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $attr_value = $this->repository()->findOrFail($request->input('attr_id'));
        $attr_value->fill($request->input('attr_value', []))->save();

        return jsonSuccess(['attr_value' => $attr_value]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $attr_value = $this->repository()->findOrFail($request->input('attr_id'));
        $attr_value->delete();

        return jsonSuccess();
    }
}
