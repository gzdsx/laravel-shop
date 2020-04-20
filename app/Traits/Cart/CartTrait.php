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
 * Time: 17:09
 */

namespace App\Traits\Cart;


use App\Models\Cart;
use App\Models\Item;
use App\Models\ItemSku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait CartTrait
{
    /**
     * @return Cart|\Illuminate\Database\Eloquent\Builder
     */
    protected function query()
    {
        return Cart::query();
    }

    /**
     * 添加购物车
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        $quantity = $request->input('quantity', 1);
        $sku_id = $request->input('sku_id', 0);
        if ($itemid && $quantity) {
            $result = $this->query()->where('uid', Auth::id())->where('itemid', $itemid)->first();
            if ($result) {
                $result->increment('quantity', $quantity);
            } else {
                $item = Item::findOrFail($itemid);
                $price = $item->price;
                $sku_title = null;
                if ($sku_id) {
                    $sku = ItemSku::find($sku_id);
                    if ($sku) {
                        $price = $sku->price;
                        $sku_title = $sku->title;
                    }
                }
                $result = $this->query()->create([
                    'itemid' => $item->itemid,
                    'title' => $item->title,
                    'thumb' => $item->thumb,
                    'image' => $item->image,
                    'sku_id' => $sku_id,
                    'sku_title' => $sku_title,
                    'price' => $price,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            $result = [];
        }
        return $this->sendSavedCartResponse($request, $result);
    }

    /**
     * @param Request $request
     * @param $item
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSavedCartResponse(Request $request, $item)
    {
        return ajaxReturn(compact('item'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        $this->query()->where('uid', Auth::id())
            ->where('itemid', $itemid)
            ->update($request->except('itemid'));
        return $this->showUpdatedCartResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showUpdatedCartResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $items = $request->post('items', []);
        $this->query()->where('uid', Auth::id())->whereIn('itemid', $items)->delete();
        return $this->sendDeletedCartResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendDeletedCartResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function truncate(Request $request)
    {
        $this->query()->where('uid', Auth::id())->delete();
        return $this->sendDeletedCartResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        $items = Cart::where('uid', Auth::id())->orderByDesc('id')->get();
        return $this->sendGetAllCartResponse($request, $items);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection $items
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendGetAllCartResponse(Request $request, $items)
    {
        return ajaxReturn([
            'items' => $items,
            'total' => $items->count()
        ]);
    }
}
