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


use App\Models\ProductReview;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait BoughtTrait
{
    use RefundTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Order
     */
    protected function repository()
    {
        return Auth::user()->boughts();
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
        $order->load(['items', 'shipping', 'buyer', 'transaction']);

        return $this->sendGetOrderResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendGetOrderResponse(Request $request, $order)
    {
        return jsonSuccess(['order' => $order]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItem(Request $request)
    {
        $item = OrderItem::with(['order'])->findOrFail($request->input('sub_order_id'));
        return jsonSuccess(['item' => $item]);
    }

    /**
     * 批量获取订单信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->repository()->with(['items'])->filter($request->all())->where('buyer_deleted', 0);
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
        return jsonSuccess(compact('total', 'items'));
    }

    /**
     * 关闭订单
     * @return \Illuminate\Http\JsonResponse
     */
    public function close(Request $request)
    {
        $order = $this->getOrder($request);
        $reason = $request->input('reason', trans('trade.close_reasons.0'));
        $order->closeReason()->firstOrNew([], ['reason' => $reason])->save();
        $order = $this->orderService()->close($order);
        return $this->sendClosedOrderResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendClosedOrderResponse(Request $request, $order)
    {
        return jsonSuccess(['order' => $order]);
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
        return jsonSuccess(['order' => $order]);
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
        return jsonSuccess(['order' => $order]);
    }

    /**
     * 确认订单
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request)
    {
        $password = $request->input('password');
        if (!Hash::check($password, Auth::user()->getAuthPassword())) {
            //abort(422, trans('user.password incorrect'));
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
        return jsonSuccess(['order' => $order]);
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
        return jsonSuccess(['order' => $order]);
    }

    /**
     * 评价订单
     * @param Request $request
     */
    public function rate(Request $request)
    {
        $order_id = $request->input('order_id');
        $reviews = $request->input('reviews', []);

        $order = $this->repository()->find($order_id);
        if (!$order->buyer_rate) {
            foreach ($reviews as $review) {
                $rev = new ProductReview($review);
                $rev->uid = Auth::id();
                $rev->order_id = $order_id;
                $rev->save();

                if (isset($review['images'])) {
                    foreach ($review['images'] as $image) {
                        $rev->images()->create($image);
                    }
                }
            }
            $order->buyer_rate = 1;
            $order->save();
        }

        return jsonSuccess(['order' => $order]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|Order
     */
    protected function getOrder(Request $request)
    {
        return $this->repository()->findOrFail($request->input('order_id'));
    }
}
