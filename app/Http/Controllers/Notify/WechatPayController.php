<?php

namespace App\Http\Controllers\Notify;


use App\Jobs\OrderProcessNotice;
use App\Models\Transaction;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Response\QueryOrderResponse;
use App\WeChat\Response\WechatPayResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatPayController extends Controller
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\Exception
     */
    public function index(Request $request)
    {
        $response = $this->payment()->handlePaidNotify(function ($message, $fail) {
            @file_put_contents(storage_path('pay.php'), json_encode($message));
            $res = new WechatPayResponse($message);
            if ($res->tradeSuccess()) {
                $transaction = Transaction::where('out_trade_no',$res->outTradeNo())->first();
                if ($transaction){
                    if ($transaction->pay_state == 0){
                        $transaction->transaction_state = 2;
                        $transaction->pay_state = 1;
                        $transaction->pay_at = now();
                        $transaction->pay_type = 'wechatpay';
                        $transaction->extra = $res->all();
                        $transaction->save();
                        if ($transaction->order){
                            $transaction->order->order_state = 2;
                            $transaction->order->pay_state = 1;
                            $transaction->order->pay_at = now();
                            $transaction->order->save();
                            dispatch(new OrderProcessNotice($transaction->order, 'paid'));
                        }
                    }
                }
            }
        });
        return $response;
    }
}
