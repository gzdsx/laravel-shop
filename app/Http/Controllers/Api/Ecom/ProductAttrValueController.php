<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EcomProductAttr;
use App\Models\EcomProductAttrValue;
use Illuminate\Http\Request;

class ProductAttrValueController extends BaseController
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
