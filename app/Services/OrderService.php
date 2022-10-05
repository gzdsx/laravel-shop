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


use App\Events\Order\OrderCancelled;
use App\Events\Order\OrderConfirmed;
use App\Events\Order\OrderCreated;
use App\Events\Order\OrderPaid;
use App\Events\Order\OrderSend;
use App\Models\Order;
use App\Models\UserTransaction;
use App\Services\Contracts\OrderServiceInterface;
use App\Support\TradeUtil;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{

    use WechatDefaultConfig;

    /**
     * @param array $items
     * @param array $address
     * @param array $options
     * @return mixed
     * @throws \Exception
     */
    public function create($items, $address, $coupon = null, $options = [])
    {
        // TODO: Implement create() method.
        if (empty($items) || count($items) === 0) {
            abort(500, 'missing items value');
        }

        if (empty($address)) {
            abort(500, 'missing address value');
        }

        $buyer = Auth::user();
        DB::beginTransaction();
        try {
            $order_no = TradeUtil::createOrderNo();
            $order = new Order([
                'order_no' => $order_no,
                'order_state' => 1,
                'buyer_name' => $buyer->username,
                'remark' => $options['remark'] ?? null,
                'pay_type' => $options['pay_type'] ?? 1,
                'shipping_type' => $options['shipping_type'] ?? 1
            ]);
            $order->buyer()->associate($buyer);
            $order->save();
            //更新配送信息
            $order->shipping->fill($address)->save();

            $productFee = 0;
            $shippingFee = 0;
            $discountFee = 0;
            $totalCount = 0;

            $details = [];

            foreach ($items as $item) {
                $sku = $item['sku'];
                $product = $item['product'];
                $quantity = $item['quantity'];
                //小计费用
                $simpleFee = bcmul($sku->price, $quantity, 2);
                //计算运费
                $freight = $this->computeFreight($product->freight_template_id, $quantity, $simpleFee);
                //商品总价
                $productFee = bcadd($productFee, $simpleFee, 2);
                //总运费
                $shippingFee = bcadd($shippingFee, $freight, 2);
                //商品总数
                $totalCount = bcadd($totalCount, $quantity, 0);
                //判断库存是否充足
                if ($quantity > $sku->stock) {
                    $order->delete();
                    abort(403, trans('product.insufficient inventory'));
                }
                //创建子菜单
                $order->items()->create([
                    'itemid' => $product->itemid,
                    'title' => $product->title,
                    'thumb' => $product->thumb,
                    'image' => $product->image,
                    'quantity' => $quantity,
                    'price' => $sku->price,
                    'sku_id' => $sku->sku_id ?? 0,
                    'sku_title' => $sku->title,
                    'product_fee' => $simpleFee,
                    'shipping_fee' => $freight,
                    'total_fee' => bcadd($simpleFee, $freight, 2)
                ]);
                //更新SKU库存
                $sku->decreaseStock($quantity);
                //更新库存和销量
                $product->incrementSold($quantity);
                $product->decreaseStock($quantity);
                $details[] = $product->title;
            }

            //创建交易流水
            $totalFee = bcadd($productFee, $shippingFee, 2);
            $orderFee = bcsub($totalFee, $discountFee, 2);
            //更新订单价格和数量
            $order->fill([
                'product_fee' => $productFee,
                'shipping_fee' => $shippingFee,
                'total_fee' => $totalFee,
                'order_fee' => $orderFee,
                'total_count' => $totalCount
            ]);

            //创建交易流水
            $transaction = UserTransaction::create([
                'type' => 2,
                'account_type' => 1,
                'out_trade_no' => TradeUtil::createTransactionNo(),
                'uid' => $buyer->uid,
                'detail' => implode('|', $details),
                'amount' => $orderFee
            ]);
            //订单和交易关联
            $order->transaction()->associate($transaction);
            $order->save();

            //添加操作记录
            $order->logs()->create([
                'uid' => $buyer->uid,
                'username' => $buyer->username,
                'content' => trans('trade.order create success')
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

            event(new OrderConfirmed($order));
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

            event(new OrderCancelled($order));
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
