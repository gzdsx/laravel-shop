<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Events\Order\OrderCreated;
use App\Http\Controllers\Api\BaseController;
use App\Models\EcomProductItem;
use App\Models\Order;
use App\Support\TradeUtil;
use App\Traits\Ecom\HasFreight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    use HasFreight;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculate(Request $request)
    {
        $itemid = $request->input('itemid');
        $sku_id = $request->input('sku_id', 0);
        $quantity = $request->input('quantity', 1);
        $is_pin = $request->input('is_pin', 0);

        $product = EcomProductItem::findOrFail($itemid);
        if (!$sku = $product->skus()->find($sku_id)) {
            $sku = $product->skus()->make([
                'stock' => $product->stock,
                'price' => $product->price,
                'pin_price' => $product->pin_price
            ]);
        }

        if ($quantity > $sku->stock) {
            abort(403, trans('product.insufficient inventory'));
        }

        $product_fee = bcmul($is_pin ? $sku->pin_price : $sku->price, $quantity, 2);
        $shipping_fee = $this->computeFreight($product->template_id, $quantity, $product_fee);
        $discount_fee = '0.00';
        return jsonSuccess([
            'sku' => $sku,
            'product' => $product,
            'quantity' => $quantity,
            'product_fee' => $product_fee,
            'shipping_fee' => bcadd($shipping_fee, 0, 2),
            'discount_fee' => bcadd($discount_fee, 0, 2),
            'order_fee' => bcsub(bcadd($product_fee, $shipping_fee, 2), $discount_fee, 2)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function create(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $itemid = $request->input('itemid');
            $sku_id = $request->input('sku_id', 0);
            $quantity = $request->input('quantity', 1);
            $pay_type = $request->input('pay_type', 1);
            $group_id = $request->input('group_id', 0);
            $order_type = $request->input('order_type', 1);

            $product = EcomProductItem::findOrFail($itemid);
            if (!$sku = $product->skus()->find($sku_id)) {
                $sku = $product->skus()->make([
                    'stock' => $product->stock,
                    'price' => $product->price,
                    'pin_price' => $product->pin_price
                ]);
            }

            if ($quantity > $sku->stock) {
                abort(500, trans('product.insufficient inventory'));
            }

            $product_fee = bcmul($order_type == 2 ? $sku->pin_price : $sku->price, $quantity, 2);
            $shipping_fee = $this->computeFreight($product->template_id, $quantity, $product_fee);
            $discount_fee = '0.00';
            $total_fee = bcadd($product_fee, $shipping_fee, 2);
            $order_fee = bcsub($total_fee, $discount_fee, 2);

            $buyer = Auth::user();
            $order = new Order();
            $order->order_no = TradeUtil::createOrderNo();
            $order->out_trade_no = TradeUtil::createOutTradeNo();
            $order->order_state = 0;
            $order->order_type = $order_type;
            $order->pay_type = $pay_type;
            $order->product_fee = $product_fee;
            $order->shipping_fee = $shipping_fee;
            $order->discount_fee = $discount_fee;
            $order->order_fee = $order_fee;
            $order->total_fee = $total_fee;
            $order->buyer_id = $buyer->uid;
            $order->buyer_name = $buyer->nickname;
            $order->remark = $request->input('remark');

            if ($shop = $product->shop) {
                $order->shop_id = $shop->shop_id;
                $order->shop_name = $shop->shop_name;
            }

            if ($seller = $product->seller) {
                $order->seller_id = $seller->uid;
                $order->seller_name = $seller->nickname;
            }

            $order->save();
            $order->items()->create([
                'itemid' => $product->itemid,
                'title' => $product->title,
                'price' => $order_type == 2 ? $sku->pin_price : $sku->price,
                'thumb' => $product->thumb,
                'image' => $product->image,
                'quantity' => $quantity,
                'sku_id' => $sku->sku_id ?? 0,
                'sku_title' => $sku->title,
                'total_fee' => $total_fee
            ]);

            //添加操作记录
            $order->logs()->create([
                'uid' => $order->buyer_id,
                'username' => $order->buyer_name,
                'content' => trans('trade.order create success')
            ]);

            //更新收货地址
            if ($address = $request->input('address')) {
                $order->shipping->fill($address)->save();
            }

            if ($order_type == 2) {
                if ($group_id) {
                    $is_chief = 0;
                    $group = $product->groups()->find($group_id);
                    if ($group->uid == Auth::id()) {
                        abort(500, '不能参加自己的团');
                    }
                } else {
                    $is_chief = 1;
                    $group = $product->groups()->create([
                        'uid' => $buyer->uid,
                        'itemid' => $itemid,
                        'order_id' => $order->order_id,
                        'num' => $product->pin_num
                    ]);
                }

                $group->items()->create([
                    'uid' => $buyer->uid,
                    'itemid' => $itemid,
                    'order_id' => $order->order_id,
                    'is_chief' => $is_chief
                ]);
            }

            event(new OrderCreated($order));
            return jsonSuccess($order);
        });
    }
}
