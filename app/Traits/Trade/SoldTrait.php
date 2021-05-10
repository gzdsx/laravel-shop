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


use App\Models\Order;
use App\Services\Contracts\OrderServiceInterface;
use App\Support\TradeUtil;
use Illuminate\Http\Request;

trait SoldTrait
{
    /**
     * @return Order|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Order::query();
    }

    /**
     * @return OrderServiceInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function orderService()
    {
        return app(OrderServiceInterface::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $order = $this->repository()->findOrFail($request->input('order_id'));
        $order->load(['buyer', 'shipping', 'items', 'transaction']);

        return jsonSuccess(['order' => $order]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->repository()->filter($request->all())->with(['items', 'buyer'])->where('seller_deleted', 0);
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
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
        if ($order->shipping) {
            $order->shipping->express_code = $request->input('express_code');
            $order->shipping->express_name = $request->input('express_name');
            $order->shipping->express_no = $request->input('express_no');
            $order->shipping->save();
        }

        $this->orderService()->send($order);
        return jsonSuccess(['order' => $order]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function forceDelete(Request $request)
    {
        $orders = $this->repository()->whereKey($request->input('items', []))->get();
        foreach ($orders as $order) {
            $order->delete();
        }
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->update(['seller_deleted' => 1]);
        return jsonSuccess();
    }
}
