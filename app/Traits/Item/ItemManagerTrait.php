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
 * Time: 10:02
 */

namespace App\Traits\Item;


use App\Repositories\Contracts\ItemCatlogRepositoryInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

trait ItemManagerTrait
{

    /**
     * @return ItemRepositoryInterface
     */
    protected function itemRepository()
    {
        return app(ItemRepositoryInterface::class)->withoutGlobalScopes();
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
     * @return mixed
     */
    public function showItems(Request $request)
    {
        $items = $this->itemRepository()->with(['catlog'])->filter($request->all())->orderByDesc('itemid')->paginate();
        return $this->showItemsView($request, $items);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Pagination\Paginator $items
     * @return mixed
     */
    protected function showItemsView(Request $request, $items)
    {
        return $items;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $items = $request->input('items', []);
        $this->itemRepository()->whereKey($items)->delete();
        return $this->sendBatchDeletedResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchDeletedResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * 批量上架
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchOnSale(Request $request)
    {
        $items = $request->input('items', []);
        $this->itemRepository()->whereKey($items)->update(['on_sale' => 1]);
        return $this->sendBatchUpdatedResponse($request);
    }

    /**
     * 批量下架
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchOffSale(Request $request)
    {
        $items = $request->input('items', []);
        $this->itemRepository()->whereKey($items)->update(['on_sale' => 0]);

        return $this->sendBatchUpdatedResponse($request);
    }

    /**
     * 批量移动
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchMove(Request $request)
    {
        $items = $request->input('items', []);
        $target = $request->input('target', 0);
        $this->itemRepository()->whereKey($items)->update(['catid' => $target]);

        return $this->sendBatchUpdatedResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchUpdatedResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function publish(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        if ($itemid) {
            $item = $this->itemRepository()->with(['images', 'content'])->findOrFail($itemid);
        } else {
            $item = $this->itemRepository()->make([
                'catid' => $request->input('catid', 0),
                'price' => '1.00',
                'market_price' => '1.00',
                'stock' => 100,
                'on_sale' => 1,
                'freight_template' => 0,
                'redpack_amount' => 0
            ]);
        }
        return $this->showPublishView($request, $item);
    }

    /**
     * @param Request $request
     * @param $item
     * @return mixed
     */
    protected function showPublishView(Request $request, $item)
    {
        return $item;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        $content = $request->input('content', []);
        $images = $request->input('images', []);
        //dd($images);
        if ($itemid) {
            $item = $this->itemRepository()->findOrFail($itemid);
            $item->update($request->input('item', []));
        } else {
            $item = $this->itemRepository()->create($request->input('item', []));
        }

        if ($content) $this->itemRepository()->updateContent($item, $content);
        if ($images) $this->itemRepository()->updateImages($item, $images);
        $item->fresh();
        return $this->sendSavedResponse($request, $item);
    }


    /**
     * @param Request $request
     * @param $item
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSavedResponse(Request $request, $item)
    {
        return ajaxReturn(['item' => $item]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->itemRepository()->whereKey($request->input('items', []))->delete();
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleSale(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        $item = $this->itemRepository()->findOrFail($itemid);
        $item->on_sale = $item->on_sale ? 0 : 1;
        $item->save();
        return ajaxReturn(['item' => $item]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $items = $request->input('items', []);
        $data = Arr::only($request->all(), ['on_sale', 'price', 'stock']);
        $this->itemRepository()->whereKey($items)->update($data);

        return $this->sendBatchUpdatedResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCatlog(Request $request)
    {

        $items = $request->input('items', []);
        $catlogs = $request->input('catlogs', []);
        if ($items && $catlogs) {
            foreach ($catlogs as $catid) {
                foreach ($items as $itemid) {
                    $data = [
                        'itemid' => $itemid,
                        'catid' => $catid
                    ];
                }
            }
        }
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        return ajaxReturn(['item' => $this->itemRepository()->findOrFail($itemid)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 10);
        return ajaxReturn(['items' => $this->itemRepository()->fetch($offset, $count)]);
    }
}
