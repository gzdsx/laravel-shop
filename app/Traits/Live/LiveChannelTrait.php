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
 * Time: 07:19
 */

namespace App\Traits\Live;


use Illuminate\Http\Request;

trait LiveChannelTrait
{
    /**
     * @return \App\Models\LiveChannel|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return \App\Models\LiveChannel::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['channel' => $this->repository()->find($request->input('channel_id'))]);
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
        $channel = $this->repository()->findOrNew($request->input('channel_id'));
        $channel->fill($request->input('channel', []))->save();
        return jsonSuccess(['channel' => $channel]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->get()->map(function ($liveChannel) {
            $liveChannel->delete();
        });

        return jsonSuccess();
    }
}
