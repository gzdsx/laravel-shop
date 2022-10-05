<?php

namespace App\Http\Controllers\Notify\Wechat;

use App\Http\Controllers\Controller;
use App\Models\DacheOrder;
use App\Models\UserTransaction;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Notify\PaidNotify;
use Illuminate\Http\Request;

class DacheController extends Controller
{
    use WechatDefaultConfig;

    const SUCCESS = 'SUCCESS';
    const FAIL = 'FAIL';

    public function paid(Request $request)
    {
        return $this->payment()->handlePaidNotify(function ($message, $fail) {
            //Storage::put('wxpay', json_encode($message));
            $notify = new PaidNotify($message);
            if ($notify->tradeSuccess()) {
                $order = DacheOrder::whereOrderNo($notify->outTradeNo())->first();
                if ($order) {
                    $order->markAsPaid();

                    $transaction = new UserTransaction();
                    $transaction->type = 2;
                    $transaction->account_type = 3;
                    $transaction->uid = $order->buyer_id;
                    $transaction->amount = $notify->totalFee() / 100;
                    $transaction->detail = '打车费';
                    $transaction->out_trade_no = $notify->outTradeNo();
                    $transaction->data = $notify->all();
                    $transaction->markAsPaid();
                }

                return true;
            }
            return $fail(static::FAIL);
        });
    }
}
