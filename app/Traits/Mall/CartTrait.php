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

namespace App\Traits\Mall;


use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait CartTrait
{
    /**
     * @return CartRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function cartRepository()
    {
        return app(CartRepositoryInterface::class);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        $quantity = $request->input('quantity', 1);
        if ($itemid && $quantity) {
            $cartitem = $this->cartRepository()->where('uid', Auth::id())->where('itemid', $itemid)->first();
            if ($cartitem) {
                $cartitem->increment('quantity', $quantity);
            } else {
                $item = app(ItemRepositoryInterface::class)->findOrFail($itemid);
                $cartitem = $this->cartRepository()->create([
                    'itemid' => $item->itemid,
                    'shop_id' => $item->shop_id,
                    'title' => $item->title,
                    'quantity' => $quantity,
                    'price' => $item->price,
                    'thumb' => $item->thumb,
                    'image' => $item->image,
                    'sku_id' => 0,
                    'sku_name' => '',
                ]);
            }
        } else {
            $cartitem = null;
        }
        return $this->sendSavedResponse($request, $cartitem);
    }

    /**
     * @param Request $request
     * @param $cartitem
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSavedResponse(Request $request, $cartitem)
    {
        return ajaxReturn(compact('cartitem'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        $this->cartRepository()->where('uid', Auth::id())
            ->where('itemid', $itemid)->update($request->except('itemid'));
        return ajaxReturn();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $items = $request->post('items', []);
        $this->cartRepository()->whereIn('itemid', $items)->where('uid', Auth::id())->delete();
        return ajaxReturn();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showCart(Request $request)
    {
        $items = $this->cartRepository()->with(['item', 'shop'])->where('uid', $request->user()->uid)->get();
        $shops = [];
        foreach ($items as $item) {
            if (!isset($shops[$item->shop_id])) {
                $shops[$item->shop_id] = [
                    'shop' => $item->shop,
                    'items' => []
                ];
            }

            $item->item->setAttribute('quantity', $item->quantity);
            $shops[$item->shop_id]['items'][] = $item->item;
        }
        return $this->showCartView($request, array_values($shops));
    }

    /**
     * @param Request $request
     * @param $shops
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showCartView(Request $request, $shops)
    {
        return ajaxReturn(['shops' => $shops]);
    }
}
