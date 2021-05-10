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

namespace App\Traits\Foundation;


use App\Models\Express;
use Illuminate\Http\Request;

trait ExpressTrait
{
    /**
     * @return Express|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Express::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['express' => $this->repository()->findOrFail($request->input('id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        return jsonSuccess(['items' => $this->repository()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $express = $this->repository()->findOrNew($request->input('id'));
        $express->fill($request->input('express', []))->save();
        return jsonSuccess(['express' => $express]);
    }

    /**
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->delete();
    }
}
