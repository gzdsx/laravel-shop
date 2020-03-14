<?php

namespace App\Http\Controllers\Api;

use App\Alipay\Alipay;
use App\Models\Order;
use Illuminate\Http\Request;

class AlipayController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function sign(Request $request)
    {
        $order_id = $request->input('order_id');
        $order = Order::with('transaction')->find($order_id);

        $params = Alipay::pay()->appPay([
            'subject' => $order->transaction->subject,
            'out_trade_no' => $order->transaction->out_trade_no,
            'total_amount' => $order->transaction->amount
        ]);

        return ajaxReturn(['payStr' => http_build_query($params)]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function query(Request $request)
    {
        $order = Order::find($request->input('order_id'));
        return ajaxReturn(['trade_no' => $order->order_no]);
    }
}
