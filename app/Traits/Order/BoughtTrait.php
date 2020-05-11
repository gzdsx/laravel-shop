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


use App\Models\ItemReviews;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Contracts\OrderServiceInterface;
use App\Support\TradeUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait BoughtTrait
{
    use RefundTrait;

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
        $order = $this->getOrder($request);
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItem(Request $request)
    {
        $order_id = $request->input('order_id');
        $itemid = $request->input('itemid');
        $item = OrderItem::where(compact('order_id', 'itemid'))->first();
        return ajaxReturn(['item' => $item]);
    }

    /**
     * 关闭订单
     * @return \Illuminate\Http\JsonResponse
     */
    public function close(Request $request)
    {
        $order = $this->getOrder($request);
        if (!$order->closed) {
            $reason = $request->input('reason', trans('trade.close_reasons.0'));
            $order->closeReason()->create(['reason' => $reason]);
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
        $order = $this->getOrder($request);
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
        $order = $this->getOrder($request);
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
        $password = $request->input('password');
        if (!Hash::check($password, Auth::user()->getAuthPassword())) {
            abort(422, __('user.password incorrect'));
        }
        $order = $this->getOrder($request);
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
    public function applyRefund(Request $request)
    {
        $order = $this->getOrder($request);
        $itemid = $request->input('itemid');
        $refund = $order->refunds()->firstOrNew(['itemid' => $itemid]);
        $refund->fill($request->input('refund', []));
        $refund->refund_no = TradeUtil::createReundNo();
        if ($order->shipping_state) {
            $order = $this->orderService()->applyRefund($order);
            $refund->refund_state = 1;
        } else {
            $this->refundMoney($order->transaction, $refund);
            $order = $this->orderService()->refund($order);
            $refund->refund_state = 2;
        }
        $refund->save();
        $refund->images()->delete();
        $images = $request->input('refund.images', []);
        foreach ($images as $image) {
            $refund->images()->create($image);
        }
        return $this->sendApplyRefundOrderResponse($request, $order);
    }


    /**
     * @param Request $request
     * @param \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendApplyRefundOrderResponse(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $order = $this->orderService()->buyerDelete($this->getOrder($request));
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
    public function review(Request $request)
    {
        $reviews = $request->input('reviews', []);
        foreach ($reviews as $review) {
            $itemReviews = ItemReviews::make($review);
            $itemReviews->user()->associate(Auth::user());
            $itemReviews->save();
        }
        $this->orderService()->buyerRate($this->getOrder($request));
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|Order
     */
    protected function getOrder(Request $request)
    {
        return Auth::user()->boughts()->findOrFail($request->input('order_id'));
    }
}
