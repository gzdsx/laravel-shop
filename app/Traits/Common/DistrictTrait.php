<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-26
 * Time: 08:57
 */

namespace App\Traits\Common;


use App\Models\CommonDistrict;
use Illuminate\Http\Request;
use Overtrue\LaravelPinyin\Facades\Pinyin;

trait DistrictTrait
{
    /**
     * @return CommonDistrict|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonDistrict::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function district(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('id'));
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function districts(Request $request)
    {
        $parent_id = $request->input('parent_id', 0);
        return json_success(['items' => $this->repository()->where('parent_id', $parent_id)->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newDistrict = $request->input('district', []);
        $model = $this->repository()->findOrNew($newDistrict['id'] ?? 0);
        $model->fill($newDistrict);

        if (!$model->pinyin) {
            $model->pinyin = Pinyin::permalink($model->name, '');
        }

        if (!$model->letter) {
            $model->letter = substr(strtoupper($model->pinyin), 0, 1);
        }

        $model->save();

        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->delete();
        return json_success();
    }
}
