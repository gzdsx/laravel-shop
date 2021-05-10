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

namespace App\Traits\Foundation;


use App\Models\Block;
use Illuminate\Http\Request;

trait BlockTrait
{
    /**
     * @return Block|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Block::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $block = $this->repository()->findOrFail($request->input('block_id'));
        return jsonSuccess([
            'block' => $block,
            'items' => $block->items()->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);
        $items = $this->repository()->offset($offset)->take($count)->get();

        return jsonSuccess(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $block = $this->repository()->findOrNew($request->input('block_id'));
        $block->fill($request->input('block', []))->save();
        return jsonSuccess(['block' => $block]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->get()->map(function ($block) {
            $block->delete();
        });
        return jsonSuccess();
    }
}
