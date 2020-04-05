<?php

namespace App\Http\Controllers\H5;

use App\Events\OrderEvent;
use App\Models\Express;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoldController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
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
     */
    public function send(Request $request)
    {
        $order = $this->orderRepository()->findOrFail($request->input('order_id'));
        $order->shipping_state = 1;
        $order->shipping_at = now();
        $order->order_state = 3;
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
}
