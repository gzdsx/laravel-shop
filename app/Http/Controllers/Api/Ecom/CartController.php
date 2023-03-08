<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EcomCart;
use App\Models\EcomProductItem;
use App\Models\EcomProductSku;
use App\Models\EcomShop;
use App\Models\Order;
use App\Support\TradeUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        $sku_id = $request->input('sku_id', 0);
        $quantity = $request->input('quantity', 1);

        $sku_title = '';
        if ($sku_id) {
            $sku = EcomProductSku::find($sku_id);
            if ($sku) {
                $sku_title = $sku->title;
            }
        }

        $product = EcomProductItem::findOrFail($request->input('itemid'));
        $cartProduct = Auth::user()->cartProducts()->where('itemid', $itemid)->first();
        if ($cartProduct) {
            $cartProduct->quantity += $quantity;
            $cartProduct->sku_id = $sku_id;
            $cartProduct->sku_title = $sku_title;
            $cartProduct->save();
        } else {
            $cartProduct = Auth::user()->cartProducts()->make();
            $cartProduct->itemid = $itemid;
            $cartProduct->sku_id = $sku_id;
            $cartProduct->sku_title = $sku_title;
            $cartProduct->quantity = $quantity;
            $cartProduct->title = $product->title;
            $cartProduct->price = $product->price;
            $cartProduct->thumb = $product->thumb;
            $cartProduct->image = $product->image;
            $cartProduct->shop_id = $product->shop_id;
            $cartProduct->save();
        }

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $itemid = $request->input('itemid');
        Auth::user()->cartProducts()->where('itemid', $itemid)->delete();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateQuantity(Request $request)
    {
        $itemid = $request->input('itemid', 0);
        $quantity = $request->input('quantity', 1);
        $model = Auth::user()->cartProducts()->where('itemid', $itemid)->firstOrFail();
        $model->quantity = $quantity;
        $model->save();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $dataList = [];
        $productList = Auth::user()->cartProducts()->get();
        foreach ($productList as $product) {
            $dataList[$product->shop_id][] = $product;
        }

        $result = [];
        $shopList = EcomShop::whereKey($productList->pluck('shop_id'))->get(['shop_id', 'shop_name']);
        foreach ($shopList as $shop) {
            $result[] = [
                'shop' => $shop,
                'items' => $dataList[$shop->shop_id]
            ];
        }

        return jsonSuccess($result);
    }

    public function confirm(Request $request)
    {
        $ids = $request->input('ids', []);
        $dataList = [];
        $productList = Auth::user()->cartProducts()->whereIn('itemid', $ids)->get();
        foreach ($productList as $product) {
            $dataList[$product->shop_id][] = $product;
        }

        $result = [];
        $shopList = EcomShop::whereKey($productList->pluck('shop_id'))->get(['shop_id', 'shop_name']);
        foreach ($shopList as $shop) {
            $result[] = [
                'shop' => $shop,
                'items' => $dataList[$shop->shop_id]
            ];
        }

        return jsonSuccess($result);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function settlement(Request $request)
    {
        $ids = $request->input('ids', []);
        $cartList = EcomCart::whereHas('product')->whereIn('itemid', $ids)->get();
        $dataList = [];
        foreach ($cartList as $cart) {
            $dataList[$cart->shop_id][] = $cart;
        }

        $shops = EcomShop::whereKey($cartList->pluck('shop_id'))->get();
        return DB::transaction(function () use ($dataList, $shops, $request, $ids) {
            foreach ($shops as $shop) {
                $buyer = Auth::user();
                $seller = $shop->seller;
                $order = new Order();
                $order->order_no = TradeUtil::createOrderNo();
                $order->out_trade_no = TradeUtil::createOutTradeNo();
                $order->order_type = 1;
                $order->order_state = 0;
                $order->buyer_id = $buyer->uid;
                $order->buyer_name = $buyer->nickname;
                if ($seller) {
                    $order->seller_id = $seller->uid;
                    $order->seller_name = $seller->nickname;
                }

                $order->shop_id = $shop->shop_id;
                $order->shop_name = $shop->shop_name;
                $order->remark = $request->input('remark');
                $order->pay_type = $request->input('pay_type', 1);
                $order->shipping_type = $request->input('shipping_type', 1);
                $order->save();

                $total_fee = 0;
                foreach ($dataList[$shop->shop_id] as $cart) {
                    $sku = $cart->sku;
                    $product = $cart->product;

                    $item = $order->items()->make();
                    $item->itemid = $product->itemid;
                    $item->title = $product->title;
                    $item->image = $product->image;
                    if ($sku) {
                        $item->price = $sku->price;
                        $item->sku_id = $sku->sku_id;
                        $item->sku_title = $sku->title;
                    } else {
                        $item->price = $product->price;
                    }
                    $item->quantity = $cart->quantity;
                    $item->save();

                    $total_fee += $item->total_fee;
                }

                $order->product_fee = $total_fee;
                $order->order_fee = $total_fee;
                $order->total_fee = $total_fee;
                $order->save();

                //添加操作记录
                $order->logs()->create([
                    'uid' => $order->buyer_id,
                    'username' => $order->buyer_name,
                    'content' => trans('trade.order create success')
                ]);

                //更新收货地址
                if ($address = $request->input('address')) {
                    $shipping = $order->shipping()->firstOrNew();
                    $shipping->fill($request->input('address', []))->save();
                }
            }

            EcomCart::whereIn('itemid', $ids)->delete();

            return jsonSuccess();
        });
    }
}
