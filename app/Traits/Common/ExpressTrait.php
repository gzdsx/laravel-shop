<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/12/20
 * Time: 10:03
 */

namespace App\Traits\Common;


use App\Models\CommonExpress;
use Illuminate\Http\Request;

trait ExpressTrait
{
    /**
     * @return CommonExpress|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonExpress::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function express(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('id'));
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function expresses(Request $request)
    {
        return json_success(['items' => $this->repository()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newExpress = $request->input('express', []);
        $model = $this->repository()->findOrNew($newExpress['id'] ?? 0);
        $model->fill($newExpress)->save();
        return json_success($model);
    }

    /**
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->delete();
    }
}
