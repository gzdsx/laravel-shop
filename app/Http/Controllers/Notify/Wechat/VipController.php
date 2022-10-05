<?php

namespace App\Http\Controllers\Notify\Wechat;

use App\Http\Controllers\Controller;
use App\Models\WechatPrePay;
use App\Models\UserTransaction;
use App\Models\UserVip;
use App\Models\UserVipLog;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Notify\PaidNotify;
use Illuminate\Http\Request;

class VipController extends Controller
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @param $appid
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\Exception
     */
    public function paid(Request $request)
    {
        return $this->payment()->handlePaidNotify(function ($message, $fail) {
            $notify = new PaidNotify($message);
            if ($notify->tradeSuccess()) {
                $prepay = WechatPrePay::find($notify->outTradeNo());
                if ($prepay) {
                    $transaction = UserTransaction::firstOrNew(['out_trade_no' => $notify->outTradeNo()]);
                    $transaction->type = 1;
                    $transaction->account_type = 2;
                    $transaction->uid = $prepay->uid;
                    $transaction->pay_type = 'wechatpay';
                    $transaction->pay_state = 1;
                    $transaction->pay_at = now();
                    $transaction->detail = $prepay->data['body'] ?? '';
                    $transaction->amount = $notify->totalFee() / 100;
                    $transaction->data = $message;
                    $transaction->save();

                    $log = new UserVipLog();
                    $log->uid = $prepay->uid;
                    $log->price = $notify->totalFee() / 100;
                    $log->order_no = $notify->outTradeNo();
                    $log->save();

                    $vip = UserVip::firstOrNew(['uid' => $prepay->uid]);
                    $vip->start_at = now();
                    $vip->end_at = now()->addYears(1);
                    $vip->save();
                }

                return true;
            }
            return $fail('FAIL');
        });
    }
}
