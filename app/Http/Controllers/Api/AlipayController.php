<?php

namespace App\Http\Controllers\Api;


use Alipay\Factory as AliPay;
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
        $order = Order::findOrFail($request->input('order_id'));
        if ($order->pay_state) {
            abort(500, trans('trade.order paid'));
        }
        if (!$transaction = $order->transaction) {
            abort(500, 'missing order transaction');
        }
        $params = AliPay::appPay(config('alipay.default'))->sendRequest([
            'subject' => $transaction->subject,
            'out_trade_no' => $transaction->out_trade_no,
            'total_amount' => $transaction->amount,
        ]);

        return jsonSuccess(['payStr' => http_build_query($params)]);
    }
}
