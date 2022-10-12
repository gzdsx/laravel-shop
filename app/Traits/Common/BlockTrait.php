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
 * Time: 09:00
 */

namespace App\Traits\Common;


use App\Models\CommonBlock;
use Illuminate\Http\Request;

trait BlockTrait
{
    /**
     * @return CommonBlock|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonBlock::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $model = $this->repository()->with(['items'])->findOrFail($request->input('id'));
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        $query = $this->repository();

        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($offset)->take($count)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('id'));
        $model->fill($request->input('block', []))->save();
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
        $this->repository()->whereKey($request->input('ids', []))->get()->each->delete();
        return jsonSuccess();
    }
}
