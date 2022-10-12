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
use Overtrue\Pinyin\Pinyin;

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
    public function getInfo(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('id'));
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getList(Request $request)
    {
        $parent_id = $request->input('parent_id', 0);
        return jsonSuccess(['items' => $this->repository()->where('parent_id', $parent_id)->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('id'));
        $model->fill($request->input('district', []));

        $pinyin = new Pinyin();
        if (!$model->pinyin) {
            $model->pinyin = $pinyin->permalink($model->name, '');
        }

        if (!$model->letter) {
            $model->letter = substr(strtoupper($model->pinyin), 0, 1);
        }

        $model->save();

        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        if ($model = $this->repository()->find($request->input('id'))) {
            $model->delete();
        }

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->delete();
        return jsonSuccess();
    }
}
