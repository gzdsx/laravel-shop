<?php

namespace App\Http\Controllers\H5;

use App\Traits\Order\BoughtTrait;
use App\WeChat\Response\RefundOrderResponse;
use Illuminate\Http\Request;

class BoughtController extends BaseController
{
    use BoughtTrait;

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['wechat.oauth']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tab = $request->input('tab');
        return $this->view('h5.boughts', compact('tab'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $order = $this->getOrderForRequest($request);
        $order->load(['shipping', 'items', 'buyer']);

        return $this->view('h5.order', compact('order'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function refund(Request $request)
    {
        $order = $this->getOrderForRequest($request);
        $res = $this->payment()->refund->byOutTradeNumber($order->order_no, createReundNo(), $order->total_fee * 100, $order->total_fee * 100);
        $response = new RefundOrderResponse($res);
        if ($response->tradeSuccess()){
            $order->order_state = 6;
            $order->closed = 1;
            $order->closed_at = now();
            $order->save();
            $order->closeReason()->create(['reason'=>'用户取消']);
            return ajaxReturn();
        }else{
            abort(400, $response->errCodeDes());
        }
    }
}
