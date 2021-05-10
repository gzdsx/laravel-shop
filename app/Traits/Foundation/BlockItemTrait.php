<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/5/11
 * Time: 00:32
 */

namespace App\Traits\Foundation;


use App\Models\BlockItem;
use Illuminate\Http\Request;

trait BlockItemTrait
{
    /**
     * @return BlockItem|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return BlockItem::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $id = $request->input('id', 0);
        return jsonSuccess(['item' => $this->repository()->findOrFail($id)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $block_id = $request->input('block_id', 0);
        $items = $this->repository()->where('block_id', $block_id)->get();

        return jsonSuccess(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $item = $this->repository()->findOrNew($request->input('id'));
        $item->fill($request->input('item', []))->save();
        return jsonSuccess(['item' => $item]);
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
