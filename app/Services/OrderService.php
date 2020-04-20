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
use App\Models\Item;
use App\Models\ItemSku;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\Contracts\OrderServiceInterface;
use App\Support\TradeUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{

    /**
     * @param Item[] $items
     * @param Address $address
     * @param array $options
     * @return mixed
     * @throws \Exception
     */
    public function create($items, $address_id, $remark = null, $coupon = null, $options = [])
    {
        // TODO: Implement create() method.
        if (empty($items)) {
            abort(400, 'invaild items value');
        }

        if (!$address_id) {
            abort(400, 'invaild addressId value');
        }

        $buyer = Auth::user();
        DB::beginTransaction();
        try {
            $order_no = TradeUtil::createOrderNo();
            $order = $buyer->boughts()->create([
                'buyer_name' => $buyer->username,
                'remark' => $remark,
                'order_no' => $order_no,
                'order_state' => 1,
            ]);

            $totalCount = 0;
            $orderFee = 0;
            $shippingFee = 0;

            $subject = $detail = null;
            foreach ($items as $item) {
                if ($item->sku_id) {
                    $sku = ItemSku::find($item->sku_id);
                    if ($item->quantity < $sku->stock) {
                        $simpleFee = $item->quantity * $sku->price;
                        $orderFee += $simpleFee;
                        $order->items()->create([
                            'itemid' => $item->itemid,
                            'title' => $item->title,
                            'thumb' => $item->thumb,
                            'image' => $item->image,
                            'quantity' => $item->quantity,
                            'price' => $sku->price,
                            'sku_id' => $sku->id,
                            'sku_title' => $sku->title,
                            'total_fee' => $item->quantity,
                            'redpack_amount' => $item->redpack_amount
                        ]);
                        $sku->stock -= $item->quantity;
                        $sku->save();

                        $totalCount += $item->quantity;
                        //更新库存
                        $sold = $item->sold + $item->quantity;
                        $stock = $item->stock - $item->quantity;
                        Item::where('itemid',$item->itemid)->update(['sold' => $sold, 'stock' => $stock]);

                        if (!$subject) $subject = $item->title;
                        if (!$detail) $detail = $item->subtitle ?? $item->title;
                    }
                } else {
                    if ($item->quantity < $item->stock) {
                        $simpleFee = $item->quantity * $item->price;
                        $orderFee += $simpleFee;
                        $order->items()->create([
                            'itemid' => $item->itemid,
                            'title' => $item->title,
                            'thumb' => $item->thumb,
                            'image' => $item->image,
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                            'total_fee' => $simpleFee,
                            'redpack_amount' => $item->get('redpack_amount') ?? 0
                        ]);

                        $totalCount += $item->quantity;
                        //更新库存
                        $sold = $item->sold + $item->quantity;
                        $stock = $item->stock - $item->quantity;
                        Item::where('itemid',$item->itemid)->update(['sold' => $sold, 'stock' => $stock]);

                        if (!$subject) $subject = $item->title;
                        if (!$detail) $detail = $item->subtitle ?? $item->title;
                    }
                }

            }

            //创建交易流水
            $totalFee = $orderFee + $shippingFee;
            $transaction = Transaction::create([
                'payer_uid' => $buyer->uid,
                'payer_name' => $buyer->username,
                'transaction_type' => 'shopping',
                'transaction_state' => 1,
                'subject' => $subject,
                'detail' => $detail,
                'amount' => $totalFee,
                'out_trade_no' => $order_no,
                'transaction_no' => TradeUtil::createTransactionNo()
            ]);

            //dd($transaction);

            //更新订单价格和数量
            $order->update([
                'order_fee' => $orderFee,
                'shipping_fee' => $shippingFee,
                'total_fee' => $totalFee,
                'total_count' => $totalCount,
                'transaction_id' => $transaction->transaction_id
            ]);

            //更新配送信息
            $address = Address::find($address_id);
            $order->shipping->update($address->only(['name', 'tel', 'province', 'city', 'district', 'street', 'postalcode']));

            //添加操作记录
            $order->actions()->create([
                'uid' => $buyer->uid,
                'username' => $buyer->username,
                'content' => trans('auction.order submitted success')
            ]);
            DB::commit();
            event(new OrderEvent($order, 'created'));
            return $order;
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(400, $exception->getMessage());
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
            if ($order->transaction) {
                $order->transaction->transaction_state = 2;
                $order->transaction->pay_state = 2;
                $order->transaction->pay_at = now();
            }
            $order->push();
            //拍下减库存
//            if ($order->shop->reduce_type == 2) {
//                $order->items()->with(['item'])->get()->map(function ($item) {
//                    $item->item->decreaseStock($item->quantity);
//                });
//            }
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
            $order->receive_at = now();
            if ($order->transaction) {
                $order->transaction->transaction_state = 4;
            }
            $order->push();
            event(new OrderEvent($order, 'confirm'));
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
        if (!$order->closed) {
            $order->order_state = 6;
            $order->closed = 1;
            $order->closed_at = now();
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
