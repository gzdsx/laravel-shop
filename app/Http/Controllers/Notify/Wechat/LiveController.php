<?php

namespace App\Http\Controllers\Notify\Wechat;

use App\Http\Controllers\Controller;
use App\Models\UserBuyLog;
use App\Models\UserTransaction;
use App\Models\WechatPrePay;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Notify\PaidNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LiveController extends Controller
{
    use WechatDefaultConfig;

    const SUCCESS = 'SUCCESS';
    const FAIL = 'FAIL';

    /**
     * @param Request $request
     * @param $appid
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\Exception
     */
    public function paid(Request $request, $appid)
    {
        return $this->payment($appid)->handlePaidNotify(function ($message, $fail) {
            Storage::put('wxpay', json_encode($message));
            $notify = new PaidNotify($message);
            if ($notify->tradeSuccess()) {
                $prepay = WechatPrePay::find($notify->outTradeNo());
                if ($prepay) {
                    $transaction = UserTransaction::firstOrNew(['out_trade_no' => $notify->outTradeNo()]);
                    $transaction->type = 'ticket';
                    $transaction->payer_id = $prepay->uid;
                    $transaction->payer_name = $prepay->username;
                    $transaction->pay_type = 'wechatpay';
                    $transaction->pay_state = 1;
                    $transaction->pay_at = now();
                    $transaction->subject = $prepay->data['body'] ?? '';
                    $transaction->amount = $notify->totalFee() / 100;
                    $transaction->data = $message;
                    $transaction->save();

                    $buyLog = UserBuyLog::find($notify->attach());
                    $buyLog->pay_state = 1;
                    $buyLog->transaction()->associate($transaction);
                    $buyLog->save();
                }

                return true;
            }
            return $fail(static::FAIL);
        });
    }
}
