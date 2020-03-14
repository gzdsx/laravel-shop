<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-20
 * Time: 17:20
 */

namespace App\Traits\Item;


use App\Repositories\Contracts\ItemCatlogRepositoryInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use Illuminate\Http\Request;

trait ItemTrait
{
    /**
     * @return ItemRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function itemRepository()
    {
        return app(ItemRepositoryInterface::class);
    }

    /**
     * @return ItemCatlogRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function catlogRepository()
    {
        return app(ItemCatlogRepositoryInterface::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        $item = $this->itemRepository()->with(['content', 'images', 'shop', 'user', 'props'])->find($itemid);
        if (!$item) {
            abort(404, trans('item.this item has been removed'));
        }
        if (!$item->content->content) {
            $item->content->content = '<p><img src="' . $item->image . '"></p>';
        }
        return ajaxReturn(['item' => $item]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);
        if (!$request->has('sort')) {
            $request->query->add(['sort' => 'default']);
        }
        $items = $this->itemRepository()->with(['shop', 'user'])->filter($request->all())->fetch($offset, $count);
        return ajaxReturn(['items' => $items]);
    }

    /**
     * @param Request $request
     * @param $itemid
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request, $itemid)
    {
        $item = $this->itemRepository()->with(['content', 'images', 'shop', 'user'])->find($itemid);
        if (!$item) {
            abort(404, trans('item.this item has been removed'));
        }
        return $this->showDetailView($request, $item);
    }

    /**
     * @param Request $request
     * @param $item
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showDetailView(Request $request, $item)
    {
        return ajaxReturn(['item' => $item]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showItems(Request $request)
    {
        if (!$request->input('sort')) {
            $request->query->add(['sort' => 'default']);
        }
        $items = $this->itemRepository()->with(['shop', 'user'])->filter($request->all())
            ->paginate($request->input('perPage', 20));
        return $this->showItemsView($request, $items);
    }

    /**
     * @param Request $request
     * @param $items
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showItemsView(Request $request, $items)
    {
        return ajaxReturn(['items' => $items]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function catlog(Request $request)
    {
        $catlogs = $this->catlogRepository()->fetchAllFromCache();
        return $this->showCatlogView($request, $catlogs);
    }

    /**
     * @param Request $request
     * @param $catlogs
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showCatlogView(Request $request, $catlogs)
    {
        return ajaxReturn(['catlogs' => $catlogs]);
    }
}
