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


use App\Models\Block;
use App\Models\BlockItem;
use Illuminate\Http\Request;

trait BlockTrait
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBlock(Request $request)
    {
        return jsonSuccess(['block' => Block::findOrFail($request->input('block_id', 0))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchgetBlock(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);
        $items = Block::offset($offset)->limit($count)->get();

        return jsonSuccess(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveBlock(Request $request)
    {
        $block = Block::findOrNew($request->input('block_id'));
        $block->fill($request->input('block', []))->save();
        return jsonSuccess(['block' => $block]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteBlock(Request $request)
    {
        Block::whereKey($request->input('items', []))->delete();
        BlockItem::whereIn('block_id', $request->input('items', []))->delete();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItem(Request $request)
    {
        $id = $request->input('id', 0);
        return jsonSuccess(['item' => BlockItem::findOrFail($id)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchgetItem(Request $request)
    {
        $block_id = $request->input('block_id', 0);
        $items = BlockItem::where('block_id', $block_id)->orderByDesc('displayorder')->get();

        return jsonSuccess(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveItem(Request $request)
    {
        $item = BlockItem::findOrNew($request->input('id'));
        $item->fill($request->input('item', []))->save();
        return jsonSuccess(['item' => $item]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteItem(Request $request){
        BlockItem::whereKey($request->input('items',[]))->delete();
        return jsonSuccess();
    }
}
