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
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Traits\Common\AuthenticatedUser;
use App\WeChat\Message\TemplateMessage;
use Illuminate\Http\Request;

trait BoughtTrait
{
    use AuthenticatedUser;

    /**
     * @return OrderRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function orderRepository()
    {
        return app(OrderRepositoryInterface::class);
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
        $order->load(['items', 'shop', 'shipping', 'transaction']);
        if (!$order->transaction) {
            $order->setAttribute('transaction', []);
        }

        if (!$order->shop) {
            $order->setAttribute('shop', []);
        }

        if (!$order->shipping) {
            $order->setAttribute('shipping', []);
        }
        return ajaxReturn(['order' => $order]);
    }

    /**
     * 批量获取订单信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);

        if (!$request->has('tab')){
            $request->query->add(['tab'=>$request->input('stateCode')]);
        }
        $items = $this->orderRepository()
            ->with('items')->filter($request->all())
            ->where('buyer_uid', $request->user()->uid)
            ->offset($offset)->limit($count)->orderByDesc('order_id')->get();
        return ajaxReturn(['items' => $items]);
    }

    /**
     * 关闭订单
     * @return \Illuminate\Http\JsonResponse
     */
    public function close(Request $request)
    {
        $order = $this->getOrderForRequest($request);
        if (!$order->closed) {
            $closeReason = $request->input('closeReason', '');
            $otherReason = $request->input('otherReason', '');
            $order->closeReason()->create([
                'reason' => $closeReason ? $closeReason : $otherReason,
            ]);
            $this->orderService()->close($order);
        }
        return $this->sendOrderClosedResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendOrderClosedResponse(Request $request, $order)
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
        $order_id = $request->input('order_id', 0);
        $order = $this->user()->boughts()->with(['shop', 'shipping'])->find($order_id);

        $message = new TemplateMessage();
        $message->setTemplateId('R-29nZ4wQT-6dRsBa5to711IYxBYsKwxTXzA4JnbUfc');
        $message->setFirst('你有订单买家已完成付款，请及时发货');
        $message->setRemark('查看订单详情');
        $message->setDataValue('orderProductPrice', $order->total_fee);
        $message->setDataValue('orderProductName', $order->items()->first()->title);
        $message->setDataValue('orderAddress', implode(' ', $order->shipping->only(['province', 'city', 'district', 'street'])));
        $message->setDataValue('orderName', $order->order_no);

        $order->shop->kefus->map(function ($kefu) use ($message) {
            $message->setTouser($kefu->openid);
            $this->officialAccount()->template_message->send($message->getMsgContent());
        });
        return $this->sendOrderNoticedResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendOrderNoticedResponse(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paid(Request $request)
    {
        $order = $this->orderService()->paid($this->getOrderForRequest($request));
        return $this->sendOrderPaidResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendOrderPaidResponse(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * 确认订单
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request)
    {
        $order = $this->orderService()->confirm($this->getOrderForRequest($request));
        return $this->sendOrderConfrimedResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendOrderConfrimedResponse(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * 申请退款
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refund(Request $request)
    {
        $order = $this->getOrderForRequest($request);
        $order->refund()->create($request->input('refund', []));
        $this->orderService()->refunding($order);
        return $this->applyRefundOrderSuccess($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
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
        $order = $this->orderService()->buyerDelete($this->getOrderForRequest($request));
        return $this->sendOrderDeletedResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendOrderDeletedResponse(Request $request, $order)
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
        $order = $this->user()->boughts()->find($order_id);

        if ($order) {
            $rate_type = $request->input('rate_type', 1);
            $message = $request->input('message', '');
            $images = $request->input('images', []);
            $product_score = $request->input('product_score', 0);
            $wuliu_score = $request->input('wuliu_score', 0);
            $service_score = $request->input('service_score', 0);

            if (!$order->buyer_rate) {
                $shop = $order->shop;
                foreach ($order->items as $item) {

                    ItemReviews::insert([
                        'uid' => $this->user()->uid,
                        'itemid' => $item->itemid,
                        'order_id' => $order->order_id,
                        'stars' => 0,
                        'message' => $message,
                        'images' => serialize($images),
                        'image_count' => count($images),
                        'created_at' => time()
                    ]);
                    Item::where('itemid', $item->itemid)->increment('reviews');

                    if ($shop) {
                        $shop->evaluates()->create([
                            'uid' => $this->user()->uid,
                            'order_id' => $order->order_id,
                            'stars' => 0,
                            'message' => $message,
                            'created_at' => time(),
                            'product_score' => $product_score,
                            'wuliu_score' => $wuliu_score,
                            'service_score' => $service_score
                        ]);
                    }
                }
                $order->buyer_rate = 1;
                $order->save();
            }
        }

        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \App\Models\Order|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Eloquent\Relations\HasMany[]
     */
    private function getOrderForRequest(Request $request)
    {
        $order_id = $request->input('order_id');
        return $this->user()->boughts()->findOrFail($order_id);
    }
}
