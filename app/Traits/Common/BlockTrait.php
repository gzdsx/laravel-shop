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


use App\Models\BlockItem;
use App\Repositories\Contracts\BlockRepositoryInterface;
use Illuminate\Http\Request;

trait BlockTrait
{
    /**
     * @return BlockRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function blockRepository()
    {
        return app(BlockRepositoryInterface::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBlock(Request $request)
    {
        $block_id = $request->input('block_id', 0);
        return ajaxReturn(['block' => $this->blockRepository()->findOrFail($block_id)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchgetBlock(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);
        $items = $this->blockRepository()->offset($offset)->limit($count)->get();

        return ajaxReturn(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItem(Request $request)
    {
        $id = $request->input('id', 0);
        return ajaxReturn(['item' => BlockItem::findOrFail($id)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchgetItem(Request $request)
    {
        $block_id = $request->input('block_id', 0);
        $items = BlockItem::where('block_id', $block_id)->orderByDesc('displayorder')->get();

        return ajaxReturn(['items' => $items]);
    }
}
