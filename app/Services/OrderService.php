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


use App\Jobs\OrderProcessNotice;
use App\Models\Address;
use App\Models\FreightTemplate;
use App\Models\Item;
use App\Models\ItemSku;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\Contracts\OrderServiceInterface;
use App\Support\TradeUtil;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Response\RefundOrderResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{

    use WechatDefaultConfig;

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
                        $freight = $this->computeFreight($item);
                        $simpleFee = $item->quantity * $sku->price + $freight;
                        $orderFee += $simpleFee;
                        $shippingFee += $freight;
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
                            'shipping_fee' => $freight,
                            'redpack_amount' => $item->redpack_amount
                        ]);
                        $sku->stock -= $item->quantity;
                        $sku->save();

                        $totalCount += $item->quantity;
                        //更新库存
                        $sold = $item->sold + $item->quantity;
                        $stock = $item->stock - $item->quantity;
                        Item::where('itemid', $item->itemid)->update(['sold' => $sold, 'stock' => $stock]);

                        if (!$subject) $subject = $item->title;
                        if (!$detail) $detail = $item->subtitle ?? $item->title;
                    }
                } else {
                    if ($item->quantity < $item->stock) {
                        $freight = $this->computeFreight($item);
                        $simpleFee = $item->quantity * $item->price + $freight;
                        $orderFee += $simpleFee;
                        $shippingFee += $freight;
                        $order->items()->create([
                            'itemid' => $item->itemid,
                            'title' => $item->title,
                            'thumb' => $item->thumb,
                            'image' => $item->image,
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                            'total_fee' => $simpleFee,
                            'shipping_fee' => $freight,
                            'redpack_amount' => $item->get('redpack_amount') ?? 0
                        ]);

                        $totalCount += $item->quantity;
                        //更新库存
                        $sold = $item->sold + $item->quantity;
                        $stock = $item->stock - $item->quantity;
                        Item::where('itemid', $item->itemid)->update(['sold' => $sold, 'stock' => $stock]);

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
            dispatch(new OrderProcessNotice($order, 'created'));
            return $order;
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(400, $exception->getMessage());
            return false;
        }
    }

    /**
     * 计算运费
     * @param $item
     * @return float|int|mixed
     */
    protected function computeFreight($item)
    {
        $shippingFee = 0;
        $template = FreightTemplate::find($item->freight_template_id);
        if ($template) {
            $shippingFee = $template->start_fee;

            if ($item->quantity > $template->free_quantity) {
                $shippingFee = 0;
            } else {
                if ($item->quantity > $template->start_quantity) {
                    $shippingFee += ceil(($item->quantity - $template->start_quantity) / $template->growth_quantity) * $template->growth_fee;
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

            if ($order->transaction) {
                $order->transaction->transaction_state = 2;
                $order->transaction->pay_state = 1;
                $order->transaction->pay_at = now();
            }
            //拍下减库存
//            if ($order->shop->reduce_type == 2) {
//                $order->items()->with(['item'])->get()->map(function ($item) {
//                    $item->item->decreaseStock($item->quantity);
//                });
//            }
            dispatch(new OrderProcessNotice($order, 'paid'));
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
        dispatch(new OrderProcessNotice($order, 'notice'));
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
            if ($order->transaction) {
                $order->transaction->transaction_state = 3;
            }
            $order->push();
            dispatch(new OrderProcessNotice($order, 'send'));
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
            dispatch(new OrderProcessNotice($order, 'confirm'));
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
            dispatch(new OrderProcessNotice($order, 'rate'));
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
     * @param Order $order
     * @return Order|\Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function refund(Order $order)
    {
        // TODO: Implement refund() method.
        if ($order->refund_state == 0) {
            //未发货直接退款
            if ($order->order_state == 2) {
                $order->order_state = 6;
                $order->refund_state = 1;
                $order->refund_at = now();
                $order->save();

                if ($transaction = $order->transaction) {
                    $transaction->transaction_state = 6;
                    $transaction->pay_state = 2;
                    $transaction->save();

                    $res = $this->payment()->refund->byTransactionId(
                        $transaction->extra['transaction_id'],
                        $order->refund->refund_no,
                        $transaction->extra['total_fee'],
                        $transaction->extra['total_fee']);
                    $response = new RefundOrderResponse($res);
                    if (!$response->tradeSuccess()) {
                        abort(400, $response->errCodeDes());
                    }
                }
                dispatch(new OrderProcessNotice($order, 'refunded'));
            } else {
                $order->order_state = 5;
                $order->refund_state = 1;
                $order->refund_at = now();
                if ($transaction = $order->transaction) {
                    $transaction->transaction_state = 5;
                }
                $order->push();
                dispatch(new OrderProcessNotice($order, 'refunding'));
            }
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
            dispatch(new OrderProcessNotice($order, 'closed'));
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
