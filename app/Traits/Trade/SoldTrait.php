<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/21
 * Time: 9:11 下午
 */

namespace App\Traits\Trade;


use App\Events\Order\OrderCancelled;
use App\Events\Order\OrderSend;
use App\Models\Order;
use App\Support\TradeUtil;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait SoldTrait
{
    /**
     * @return Order|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Order::withGlobalScope('avalaible', function (Builder $builder) {
            return $builder->where('seller_deleted', 0);
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('order_id'));
        $model->load(['items', 'shipping', 'transaction', 'discounts']);

        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository()->filter($request->all());
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->with(['items', 'shipping'])
                ->offset($request->input('offset', 0))
                ->limit($request->input('count', 10))->orderByDesc('order_id')->get()
        ]);
    }

    /**
     * 调整价格
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function adjustPrice(Request $request)
    {
        $order_fee = floatval($request->input('order_fee'));
        $order = $this->repository()->findOrFail($request->input('order_id'));
        if ($order->order_state == 1) {
            $discount_fee = bcsub($order->total_fee, $order_fee);
            $order->order_fee = $order_fee;
            $order->discount_fee = $discount_fee;
            $order->save();
            if ($order->transaction) {
                $order->transaction->amount = $order_fee;
                $order->transaction->out_trade_no = TradeUtil::createOrderNo();
                $order->transaction->save();
            }
        }

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        $order = $this->repository()->findOrFail($request->input('order_id'));
        if ($order->order_state == 2) {
            $shipping = $order->shipping()->firstOrNew();
            $shipping->express_code = $request->input('express_code');
            $shipping->express_name = $request->input('express_name');
            $shipping->express_no = $request->input('express_no');
            $shipping->save();

            $order->markAsShipped();

            event(new OrderSend($order));
        }

        return jsonSuccess($order);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function forceDelete(Request $request)
    {
        $order = $this->repository()->findOrFail($request->input('order_id'));
        $order->forceDelete();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $order = $this->repository()->findOrFail($request->input('order_id'));
        $order->seller_deleted = 1;
        $order->save();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function accept(Request $request)
    {
        $order = $this->repository()->findOrFail($request->input('order_id'));
        if ($order->isPaid()) {
            $order->markAsAccepted();
        }

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(Request $request)
    {
        $order = $this->repository()->findOrFail($request->input('order_id'));
        $order->markAsCancelled();

        event(new OrderCancelled($order));

        return jsonSuccess();
    }
}
