<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-23
 * Time: 10:04
 */

namespace App\Traits\Item;


use App\Repositories\Contracts\ItemCollectRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait ItemCollectTrait
{
    /**
     * @return ItemCollectRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function collectRepository()
    {
        return app(ItemCollectRepositoryInterface::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $collect = $this->collectRepository()->addCollect($request->input('itemid'));
        return $this->sendSaveResponse($request, $collect);
    }

    /**
     * @param Request $request
     * @param $collect
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSaveResponse(Request $request, $collect)
    {
        return ajaxReturn(['collect' => $collect]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $items = $request->input('items', []);
        $this->collectRepository()->whereKey($items)->delete();
        return $this->sendDeletedResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendDeletedResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function showCollectedItems(Request $request)
    {
        $items = Auth::user()->collectedItems()->orderByDesc('id')->paginate(10);
        return $this->showCollectedItemsView($request, $items);
    }

    /**
     * @param Request $request
     * @param $items
     * @return mixed
     */
    protected function showCollectedItemsView(Request $request, $items)
    {
        return ['items' => $items];
    }
}
