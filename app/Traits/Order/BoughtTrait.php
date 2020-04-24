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

namespace App\Traits\Order;


use App\Models\Order;
use App\Services\Contracts\OrderServiceInterface;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait BoughtTrait
{
    use WechatDefaultConfig;

    /**
     * @return Order|\Illuminate\Database\Eloquent\Builder
     */
    protected function query()
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
        $order = $this->getOrderForRequest($request);
        $order->load(['items', 'shipping', 'buyer']);

        return $this->sendGetOrderResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendGetOrderResponse(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * 批量获取订单信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        if (!$request->has('tab')) {
            $request->query->add(['tab' => $request->input('stateCode')]);
        }
        $query = Auth::user()->boughts()->with('items')->filter($request->all())->where('buyer_deleted', 0);
        $total = $query->count();
        $items = $query->offset($request->input('offset', 0))
            ->limit($request->input('count', 10))->orderByDesc('order_id')->get();

        return $this->sendBatchGetOrderResponse($request, $items, $total);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Order[] $items
     * @param int $total
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchGetOrderResponse(Request $request, $items, $total)
    {
        return ajaxReturn(compact('total', 'items'));
    }

    /**
     * 关闭订单
     * @return \Illuminate\Http\JsonResponse
     */
    public function close(Request $request)
    {
        $order = $this->getOrderForRequest($request);
        if (!$order->closed) {
            $reason = $request->input('reason', '');
            $otherReason = $request->input('otherReason', '拍错了,不想要了');
            $order->closeReason()->create([
                'reason' => $reason ?: $otherReason,
            ]);

            $this->orderService()->close($order);
        }
        return $this->sendClosedOrderResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendClosedOrderResponse(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paid(Request $request)
    {
        $order = $this->getOrderForRequest($request);
        if ($order->order_state == 1) {
            $this->orderService()->paid($order);
        }
        return $this->sendPaidOrderResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendPaidOrderResponse(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * 提醒卖家发货
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function notice(Request $request)
    {
        $order = $this->getOrderForRequest($request);
        $this->orderService()->notice($order);
        return $this->sendNoticedOrderResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendNoticedOrderResponse(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * 确认订单
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request)
    {
        $order = $this->getOrderForRequest($request);
        $this->orderService()->confirm($order);
        return $this->sendConfrimedOrderResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendConfrimedOrderResponse(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * 申请退款
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function refund(Request $request)
    {
        $order = $this->getOrderForRequest($request);
        if (!$order->refund_state) {
            $order->refund()->create($request->input('refund', []));
            $this->orderService()->refund($order);
        }
        return $this->applyRefundOrderSuccess($request, $order);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function applyRefundOrderSuccess(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $order = $this->getOrderForRequest($request);
        if ($order) {
            $order->buyer_deleted = 1;
            $order->save();
        }
        return $this->sendDeletedOrderResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendDeletedOrderResponse(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function evaluate(Request $request)
    {
        $order_id = $request->input('order_id');

        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Eloquent\Relations\HasMany[]
     */
    protected function getOrderForRequest(Request $request)
    {
        return Auth::user()->boughts()->findOrFail($request->input('order_id'));
    }
}
