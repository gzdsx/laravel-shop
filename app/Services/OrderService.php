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
 * Time: 14:13
 */

namespace App\Services;


use App\Events\OrderClosed;
use App\Events\OrderConfirmd;
use App\Events\OrderCreated;
use App\Events\OrderPaid;
use App\Events\OrderSend;
use App\Models\FreightTemplate;
use App\Models\ProductItem;
use App\Models\ProductSku;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\Contracts\OrderServiceInterface;
use App\Support\TradeUtil;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{

    use WechatDefaultConfig;

    /**
     * @param ProductItem[] $products
     * @param array $address
     * @param array $options
     * @return mixed
     * @throws \Exception
     */
    public function create($products, $address, $remark = null, $coupon = null, $options = [])
    {
        // TODO: Implement create() method.
        if (empty($products)) {
            abort(500, 'missing products value');
        }

        if (empty($address)) {
            abort(500, 'missing address value');
        }

        $buyer = Auth::user();
        DB::beginTransaction();
        try {
            $order_no = TradeUtil::createOrderNo();
            $order = new Order([
                'buyer_name' => $buyer->username,
                'remark' => $remark,
                'order_no' => $order_no,
                'order_state' => 1,
            ]);
            $order->buyer()->associate($buyer);
            $order->save();

            $totalCount = 0;
            $goodsFee = 0;
            $shippingFee = 0;
            $discountFee = 0;

            $subjects = [];
            bcscale(2);
            foreach ($products as $product) {
                $freight = $this->computeFreight($product);
                if ($product->sku_id) {
                    $sku = ProductSku::findOrFail($product->sku_id);
                    if ($product->quantity < $sku->stock) {
                        $simpleFee = bcadd(bcmul($product->quantity, $sku->price), $freight, 2);
                        $goodsFee = bcadd($goodsFee, $simpleFee, 2);
                        $shippingFee = bcadd($shippingFee, $freight, 2);
                        $totalCount = bcadd($totalCount, $product->quantity, 0);

                        $order->items()->create([
                            'itemid' => $product->itemid,
                            'title' => $product->title,
                            'thumb' => $product->thumb,
                            'image' => $product->image,
                            'quantity' => $product->quantity,
                            'price' => $sku->price,
                            'sku_id' => $sku->sku_id,
                            'sku_title' => $sku->title,
                            'total_fee' => $simpleFee,
                            'shipping_fee' => $freight,
                            'redpack_amount' => $product->redpack_amount
                        ]);
                        $sku->decreaseStock($product->quantity);
                        //更新库存
                        $sold = $product->sold + $product->quantity;
                        $stock = $product->stock - $product->quantity;
                        ProductItem::where('itemid', $product->itemid)->update(['sold' => $sold, 'stock' => $stock]);

                        $subjects[] = $product->title;
                    } else {
                        $order->delete();
                        abort(500, trans('product.insufficient inventory'));
                    }
                } else {
                    if ($product->quantity < $product->stock) {
                        $simpleFee = bcadd(bcmul($product->quantity, $product->price), $freight);
                        $goodsFee = bcadd($goodsFee, $simpleFee);
                        $shippingFee = bcadd($shippingFee, $freight);
                        $totalCount = bcadd($totalCount, $product->quantity, 0);

                        $order->items()->create([
                            'itemid' => $product->itemid,
                            'title' => $product->title,
                            'thumb' => $product->thumb,
                            'image' => $product->image,
                            'quantity' => $product->quantity,
                            'price' => $product->price,
                            'total_fee' => $simpleFee,
                            'shipping_fee' => $freight,
                            'redpack_amount' => $product->get('redpack_amount') ?? 0
                        ]);
                        //更新库存
                        $sold = $product->sold + $product->quantity;
                        $stock = $product->stock - $product->quantity;
                        ProductItem::where('itemid', $product->itemid)->update(['sold' => $sold, 'stock' => $stock]);

                        $subjects[] = $product->title;
                    } else {
                        $order->delete();
                        abort(500, trans('product.insufficient inventory'));
                    }
                }
            }

            //创建交易流水
            $totalFee = bcadd($goodsFee, $shippingFee, 2);
            $orderFee = bcsub($totalFee, $discountFee, 2);
            //更新订单价格和数量
            $order->fill([
                'goods_fee' => $goodsFee,
                'shipping_fee' => $shippingFee,
                'total_fee' => $totalFee,
                'order_fee' => $orderFee,
                'total_count' => $totalCount
            ]);

            //创建交易流水
            $transaction = Transaction::create([
                'transaction_type' => 'shopping',
                'out_trade_no' => TradeUtil::createTransactionNo(),
                'payer_id' => $buyer->uid,
                'payer_name' => $buyer->username,
                'subject' => implode('|', $subjects),
                'amount' => $orderFee
            ]);
            //订单和交易关联
            $order->transaction()->associate($transaction);
            $order->save();

            //更新配送信息
            $order->shipping->fill($address)->save();

            //添加操作记录
            $order->logs()->create([
                'uid' => $buyer->uid,
                'username' => $buyer->username,
                'content' => trans('auction.order submitted success')
            ]);
            DB::commit();
            event(new OrderCreated($order));
            return $order;
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, $exception->getMessage());
            return false;
        }
    }

    /**
     * 计算运费
     * @param $product
     * @return float|int|mixed
     */
    protected function computeFreight($product)
    {
        $shippingFee = 0;
        $template = FreightTemplate::find($product->freight_template_id);
        if ($template) {
            $shippingFee = $template->start_fee;

            if ($product->quantity > $template->free_quantity) {
                $shippingFee = 0;
            } else {
                if ($product->quantity > $template->start_quantity) {
                    $shippingFee += ceil(($product->quantity - $template->start_quantity) / $template->growth_quantity) * $template->growth_fee;
                }

                if ($shippingFee > $template->free_amount) $shippingFee = 0;
            }
        }

        return $shippingFee;
    }

    /**
     * 付款
     * @param Order $order
     * @return Order
     */
    public function paid(Order $order)
    {
        // TODO: Implement paid() method.
        if ($order->order_state == 1) {
            $order->order_state = 2;
            $order->pay_state = 1;
            $order->pay_at = now();
            $order->save();
            //拍下减库存
//            if ($order->shop->reduce_type == 2) {
//                $order->items()->with(['item'])->get()->map(function ($item) {
//                    $item->item->decreaseStock($item->quantity);
//                });
//            }
            event(new OrderPaid($order));
        }
        return $order;
    }

    /**
     * @param Order $order
     * @return Order
     */
    public function notice(Order $order)
    {
        // TODO: Implement notice() method.
        return $order;
    }

    /**
     * 发货
     * @param Order $order
     * @return Order
     */
    public function send(Order $order)
    {
        // TODO: Implement send() method.
        if ($order->order_state == 2) {
            $order->order_state = 3;
            $order->shipping_state = 1;
            $order->shipping_at = now();
            $order->save();

            event(new OrderSend($order));
        }
        return $order;
    }

    /**
     * 确认
     * @param Order $order
     * @return Order
     */
    public function confirm(Order $order)
    {
        // TODO: Implement confirm() method.
        if ($order->order_state == 3) {
            $order->order_state = 4;
            $order->receive_state = 1;
            $order->receive_at = now();
            $order->save();

            event(new OrderConfirmd($order));
        }
        return $order;
    }

    /**
     * @param Order $order
     * @return Order
     */
    public function buyerRate(Order $order)
    {
        // TODO: Implement buyerReview() method.
        $order->buyer_rate = 1;
        $order->save();
        return $order;
    }

    /**
     * @param Order $order
     * @return Order
     */
    public function sellerRate(Order $order)
    {
        // TODO: Implement sellerReview() method.
        $order->seller_rate = 1;
        $order->save();
        return $order;
    }

    /**
     * 关闭
     * @param Order $order
     * @return Order
     */
    public function close(Order $order)
    {
        // TODO: Implement close() method.
        if (!$order->closed) {
            $order->order_state = 5;
            $order->closed = 1;
            $order->closed_at = now();
            $order->save();

            event(new OrderClosed($order));
        }
        return $order;
    }

    /**
     * @param Order $order
     * @return Order|mixed
     */
    public function buyerDelete(Order $order)
    {
        // TODO: Implement buyerDelete() method.
        $order->buyer_deleted = 1;
        $order->save();
        return $order;
    }

    /**
     * @param Order $order
     * @return Order|mixed
     */
    public function sellerDelete(Order $order)
    {
        // TODO: Implement sellerDelete() method.
        $order->seller_deleted = 1;
        $order->save();
        return $order;
    }
}
