<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/8/21
 * Time: 03:16
 */

namespace App\Traits\Common;


use App\Models\CommonAd;
use Illuminate\Http\Request;

trait AdTrait
{
    /**
     * @return CommonAd|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonAd::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ad(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('id'));
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ads(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        $query = $this->repository();
        return json_success([
            'total' => $query->count(),
            'items' => $query->offset($offset)->limit($count)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newAd = $request->input('ad', []);
        $model = $this->repository()->findOrNew($newAd['id'] ?? 0);
        $model->fill($newAd)->save();
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->update($request->input('data', []));
        return json_success();
    }
}
