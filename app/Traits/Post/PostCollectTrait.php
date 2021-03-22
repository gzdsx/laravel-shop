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
 * Time: 07:50
 */

namespace App\Traits\Post;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait PostCollectTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function repository()
    {
        return Auth::user()->postCollects();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $collect = $this->repository()->firstOrCreate(['aid' => $request->input('aid')]);
        return jsonSuccess(['collect' => $collect]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereIn('aid', $request->input('items', []))->delete();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->repository()->with('post')->whereHas('post');
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))
                ->orderByDesc('id')->get()
        ]);
    }
}
