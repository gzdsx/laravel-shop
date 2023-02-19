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
 * Time: 13:57
 */

namespace App\Traits\Trade;


use App\Events\Order\OrderCancelled;
use App\Events\Order\OrderConfirmed;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait BoughtTrait
{
    use RefundTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Order
     */
    protected function repository()
    {
        return Auth::user()->boughts()->withGlobalScope('avalaible', function (Builder $builder) {
            return $builder->where('buyer_deleted', 0);
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('order_id'));
        $model->load(['items', 'shipping', 'seller', 'transaction', 'discounts']);

        return jsonSuccess($model);
    }

    /**
     * 批量获取订单信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository()->filter($request->all());
        $total = $query->count();
        $items = $query->with(['items'])->offset($request->input('offset', 0))
            ->limit($request->input('count', 10))->orderByDesc('order_id')->get();

        return jsonSuccess([
            'total' => $total,
            'items' => $items
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItemInfo(Request $request)
    {
        $model = OrderItem::findOrFail($request->input('sub_order_id'));
        return jsonSuccess($model);
    }

    /**
     * 取消订单
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(Request $request)
    {
        $order = $this->repository()->findOrFail($request->input('order_id'));
        $order->fill(['cancel_reason' => $request->input('reason')])->markAsCancelled();
        event(new OrderCancelled($order));

        return jsonSuccess();
    }

    /**
     * 提醒卖家发货
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function notice(Request $request)
    {
        $order = $this->repository()->findOrFail($request->input('order_id'));

        return jsonSuccess();
    }

    /**
     * 确认订单
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request)
    {
        $order = $this->repository()->findOrFail($request->input('order_id'));
        //if ($order->isShipped()) {
        $order->markAsReceived();
        event(new OrderConfirmed($order));
        //}

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $order = $this->repository()->findOrFail($request->input('order_id'));
        $order->buyer_deleted = 1;
        $order->save();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTradeDetail(Request $request)
    {
        $trade = OrderItem::find($request->input('trade_id'));

        return jsonSuccess($trade);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTradeList(Request $request)
    {
        $order = $this->repository()->findOrFail($request->input('order_id'));

        return jsonSuccess([
            'total' => $order->items()->count(),
            'items' => $order->items
        ]);
    }
}
