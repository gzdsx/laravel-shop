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

namespace App\Traits\Ecom;


use App\Models\EcomCart;
use App\Models\EcomProductItem;
use App\Models\EcomProductSku;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait CartTrait
{
    /**
     * @return EcomCart|\Illuminate\Database\Eloquent\Builder|HasMany
     */
    protected function repository()
    {
        return Auth::user()->carts();
    }

    /**
     * 添加购物车
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        $sku_id = $request->input('sku_id', 0);
        $quantity = $request->input('quantity', 1);

        $product = EcomProductItem::findOrFail($itemid);
        $price = $product->price;
        $sku_title = null;
        if ($sku_id) {
            $sku = EcomProductSku::find($sku_id);
            if ($sku) {
                $price = $sku->price;
                $sku_title = $sku->title;
            }
        }

        $cart = $this->repository()->firstOrNew(['itemid' => $itemid]);
        $cart->fill([
            'title' => $product->title,
            'thumb' => $product->thumb,
            'image' => $product->image,
            'sku_id' => $sku_id,
            'sku_title' => $sku_title,
            'price' => $price,
            'quantity' => $quantity,
        ])->save();
        return $this->sendSavedCartResponse($request, $cart);
    }

    /**
     * @param Request $request
     * @param $item
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSavedCartResponse(Request $request, $cart)
    {
        return jsonSuccess(compact('cart'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        $cart = $this->repository()->firstOrNew(['itemid' => $itemid]);
        $cart->fill($request->except(['itemid']))->save();
        return $this->showUpdatedCartResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showUpdatedCartResponse(Request $request)
    {
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $this->repository()->whereIn('itemid', $request->post('items', []))->delete();
        return $this->sendDeletedCartResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendDeletedCartResponse(Request $request)
    {
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function truncate(Request $request)
    {
        $this->repository()->delete();
        return $this->sendDeletedCartResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function move(Request $request)
    {
        foreach ($this->repository()->whereIn('itemid', $request->input('items', []))->get() as $product) {
            $collect = Auth::user()->productCollects()->firstOrNew(['itemid' => $product->itemid]);
            $collect->fill([
                'title' => $product->title,
                'image' => $product->image,
                'price' => $product->price
            ])->save();
        }

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        $items = $this->repository()->orderByDesc('id')->get();
        return $this->sendGetAllCartResponse($request, $items);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection $items
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendGetAllCartResponse(Request $request, $items)
    {
        return jsonSuccess([
            'items' => $items,
            'total' => $items->count()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItems(Request $request)
    {
        $items = $this->repository()->whereIn('itemid', explode(',', $request->input('items')))->get();
        return jsonSuccess(['items' => $items]);
    }
}
