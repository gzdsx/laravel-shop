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

trait ProductAttrValueTrait
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
        $model = EcomProductAttr::findOrFail($request->input('attr_cate_id'));
        $model->load(['attrValues']);

        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('attr_id'));
        $model->fill($request->input('attr_value', []))->save();

        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('attr_id'));
        $model->delete();

        return jsonSuccess();
    }
}
