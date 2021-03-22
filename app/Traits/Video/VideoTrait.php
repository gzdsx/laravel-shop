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
 * Time: 07:32
 */

namespace App\Traits\Video;


use App\Models\Video;
use Illuminate\Http\Request;

trait VideoTrait
{
    /**
     * @return Video|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Video::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $video = $this->repository()->findOrFail($request->input('id'));
        $video->increment('views');
        return jsonSuccess(['video' => $video]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        return jsonSuccess([
            'total' => $this->repository()->count(),
            'items' => $this->repository()->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))
                ->orderByDesc('id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $video = $this->repository()->findOrNew($request->input('id'));
        $video->fill($request->input('video', []))->save();
        return jsonSuccess(['video' => $video]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->delete();
        return jsonSuccess();
    }
}
