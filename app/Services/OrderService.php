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


use App\Events\OrderEvent;
use App\Models\Address;
use App\Models\Order;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{

    /**
     * @param array $items
     * @param Address $address
     * @param array $options
     * @return mixed
     * @throws \Exception
     */
    public function create(array $items, Address $address, $options = [])
    {
        // TODO: Implement create() method.
        if (empty($items)) {
            abort(400, 'invaild items value');
        }

        if (!$address) {
            abort(400, 'invaild addressId value');
        }

        $buyer = Auth::user();
        DB::beginTransaction();
        try {
            $order_no = createOrderNo();
            $order = $buyer->boughts()->create([
                'buyer_name' => $buyer->username,
                'buyer_message' => $options['buyer_message'] ?? null,
                'order_no' => $order_no,
                'order_state' => 1,
            ]);

            $order_fee = 0;
            $shippine_fee = 0;
            $subject = $detail = '';
            foreach ($items as $item) {
                if (!$item->quantity) $item->quantity = 1;
                $simple_fee = $item->price * $item->quantity;
                $order_fee += $simple_fee;
                $order->items()->create([
                    'itemid' => $item->itemid,
                    'title' => $item->title,
                    'price' => $item->price,
                    'thumb' => $item->thumb,
                    'image' => $item->image,
                    'quantity' => $item->quantity,
                    'total_fee' => $simple_fee,
                    'redpack_amount' => $item->redpack_amount
                ]);

                $item->increment('sold', $item->quantity);

                if (!$subject) $subject = $item->title;
                if (!$detail) $detail = $item->subtitle ?: $item->title;
            }

            //更新订单价格
            $total_fee = $order_fee + $shippine_fee;
            $order->update([
                'order_fee' => $order_fee,
                'shipping_fee' => $shippine_fee,
                'total_fee' => $total_fee
            ]);

            //更新配送信息
            $order->shipping->update($address->only(['name', 'tel', 'province', 'city', 'district', 'street', 'postalcode']));

            //添加操作记录
            $order->actions()->create([
                'uid' => $buyer->uid,
                'username' => $buyer->username,
                'content' => trans('auction.order submitted success')
            ]);
            DB::commit();
            //event(new OrderEvent($order, 'created'));
            $order->load(['buyer', 'shipping', 'items']);
            return $order;
        } catch (\Exception $exception) {
            DB::rollBack();
            abort($exception->getCode(), $exception->getMessage());
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
            $order->pay_at = time();
            if ($order->transaction) {
                $order->transaction->transaction_state = 2;
                $order->transaction->pay_state = 2;
                $order->transaction->pay_at = time();
            }
            $order->push();
            //拍下减库存
            if ($order->shop->reduce_type == 2) {
                $order->items()->with(['item'])->get()->map(function ($item) {
                    $item->item->decreaseStock($item->quantity);
                });
            }
            event(new OrderEvent($order, 'paid'));
        }
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
            $order->shipping_at = time();
            if ($order->transaction) {
                $order->transaction->transaction_state = 3;
            }
            $order->push();
            event(new OrderEvent($order, 'send'));
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
            $order->receive_at = time();
            if ($order->transaction) {
                $order->transaction->transaction_state = 4;
            }
            $order->push();
            event(new OrderEvent($order, 'confirmed'));
        }
        return $order;
    }


    /**
     * 评价
     * @param Order $order
     * @return Order|void
     */
    public function reate(Order $order)
    {
        // TODO: Implement reate() method.
        if ($order->order_state == 4 && !$order->buyer_rate) {
            $order->buyer_rate = 1;
            $order->save();
            event(new OrderEvent($order, 'rate'));
        }
        return $order;
    }

    public function buyerReview(Order $order)
    {
        // TODO: Implement buyerReview() method.
    }

    public function sellerReview(Order $order)
    {
        // TODO: Implement sellerReview() method.
    }

    /**
     * 申请退款
     * @param Order $order
     * @return Order
     */
    public function refunding(Order $order)
    {
        // TODO: Implement refund() method.
        $order->order_state = 5;
        $order->refund_state = 1;
        $order->refund_at = time();
        if ($order->transaction) {
            $order->transaction->transaction_state = 5;
        }
        $order->push();
        event(new OrderEvent($order, 'refunding'));
        return $order;
    }

    /**
     * 退款完成
     * @param Order $order
     * @return Order
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function refund(Order $order)
    {
        // TODO: Implement refund() method.
        if ($order->refund_state !== 2) {
            $order->order_state = 6;
            $order->refund_state = 2;
            $order->refund_at = time();
            if ($transaction = $order->transaction) {
                $transaction->transaction_state = 6;
            }
            $order->push();
            event(new OrderEvent($order, 'refunded'));
        }
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
        if (!$order->closed && !$order->pay_state) {
            $order->order_state = 6;
            $order->closed = 1;
            $order->closed_at = time();
            if ($order->transaction) {
                $order->transaction->transaction_state = 6;
            }
            $order->push();
            event(new OrderEvent($order, 'closed'));
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
