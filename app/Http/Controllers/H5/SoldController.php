<?php

namespace App\Http\Controllers\H5;

use App\Events\OrderEvent;
use App\Models\Express;
use App\Models\OrderItem;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;

class SoldController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('wechat.oauth');
    }

    /**
     * @return OrderRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function orderRepository()
    {
        return app(OrderRepositoryInterface::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $expresses = Express::all();
        $order = $this->getOrderWithRequest($request);

        return $this->view('h5.sold.order', compact('order', 'expresses'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $order = $this->getOrderWithRequest($request);
        return ajaxReturn(['order' => $order]);
    }

    /**
     * @param Request $request
     * @return \App\Models\Order|\Illuminate\Database\Eloquent\Model
     */
    protected function getOrderWithRequest(Request $request)
    {
        $order = $this->orderRepository()->findOrFail($request->input('order_id'));
        $order->load(['buyer', 'items', 'shipping']);
        return $order;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        $order = $this->orderRepository()->findOrFail($request->input('order_id'));
        $order->order_state = 3;
        $order->shipping_state = 1;
        $order->shipping_at = now();
        $order->save();

        if ($order->shipping) {
            $express = Express::find($request->input('express_id'));
            if ($express) {
                $order->shipping->express_code = $express->code;
                $order->shipping->express_name = $express->name;
                $order->shipping->express_no = $request->input('express_no');
                $order->shipping->save();
            }
        }

        event(new OrderEvent($order, 'send'));
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editPrice(Request $request)
    {
        $order_id = $request->input('order_id');
        $items = $request->input('items', []);
        $order_fee = 0;
        foreach ($items as $item) {
            $total_fee = $item['price'] * $item['quantity'];
            OrderItem::where('order_id', $order_id)
                ->where('itemid', $item['itemid'])
                ->update([
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total_fee' => $total_fee
                ]);
            $order_fee += $total_fee;
        }
        $order = $this->orderRepository()->findOrFail($request->input('order_id'));
        $order->fill(['order_fee' => $order_fee, 'total_fee' => $total_fee, 'order_no' => createOrderNo()])->save();
        $order->load(['buyer', 'items', 'shipping']);
        return ajaxReturn(['order' => $order]);
    }
}
