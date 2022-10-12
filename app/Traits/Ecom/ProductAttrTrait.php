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
 * Time: 14:10
 */

namespace App\Traits\Ecom;


use App\Models\EcomProductAttr;
use Illuminate\Http\Request;

trait ProductAttrTrait
{
    /**
     * @return EcomProductAttr|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return EcomProductAttr::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('attr_cate_id'));
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $items = $this->repository()->get();
        return jsonSuccess([
            'total' => $items->count(),
            'items' => $items
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('attr_cate_id'));
        $model->fill($request->input('attr', []))->save();

        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('attr_cate_id'));
        $model->delete();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAttrValue(Request $request)
    {
        $attr_title = $request->input('attr_title');
        $attr_value = $request->input('attr_value');

        $attr = $this->repository()->firstOrCreate(['attr_title' => $attr_title]);
        $value = $attr->attrValues()->firstOrCreate(['attr_value' => $attr_value]);

        return jsonSuccess($value);
    }
}
