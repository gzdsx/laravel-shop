<?php

namespace App\Http\Controllers\Notify\Wechat;

use App\Http\Controllers\Controller;
use App\Models\PeisongOrder;
use App\Models\UserTransaction;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Notify\PaidNotify;
use Illuminate\Http\Request;

class PeiSongController extends Controller
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
                $transaction = UserTransaction::findByOutTradeNo($notify->outTradeNo());
                if ($transaction) {
                    if ($transaction->isUnPaid()) {
                        $transaction->forceFill([
                            'pay_type' => 'wechatpay',
                            'data' => $message
                        ])->markAsPaid();

                        $order = PeisongOrder::whereTransactionId($transaction->transaction_id)->first();
                        if ($order) $order->markAdPaid();
                    }
                }
                return true;
            }
            return $fail(static::FAIL);
        });
    }
}
