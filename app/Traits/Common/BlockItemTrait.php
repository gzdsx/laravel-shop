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

namespace App\Traits\Common;


use App\Models\CommonBlock;
use App\Models\CommonBlockItem;
use Illuminate\Http\Request;

trait BlockItemTrait
{
    /**
     * @return CommonBlockItem|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonBlockItem::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function item(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('id'));
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function items(Request $request)
    {

        $block = CommonBlock::findOrFail($request->input('block_id'));

        return json_success([
            'block' => $block,
            'items' => $block->items
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newItem = $request->input('newItem', []);
        $model = $this->repository()->findOrNew($newItem['id'] ?? 0);
        $model->fill($newItem)->save();
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
}
