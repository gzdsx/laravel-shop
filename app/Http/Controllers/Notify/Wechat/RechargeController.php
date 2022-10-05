<?php

namespace App\Http\Controllers\Notify\Wechat;


use App\Http\Controllers\Controller;
use App\Models\UserTransaction;
use App\Models\WechatPrePay;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Notify\PaidNotify;
use Illuminate\Http\Request;

class RechargeController extends Controller
{
    use WechatDefaultConfig;

    const SUCCESS = 'SUCCESS';
    const FAIL = 'FAIL';

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\Exception
     */
    public function paid(Request $request)
    {
        return $this->payment()->handlePaidNotify(function ($message, $fail) {
            $notify = new PaidNotify($message);
            if ($notify->tradeSuccess()) {
                $amount = $notify->totalFee() / 100;
                $prePay = WechatPrePay::find($notify->outTradeNo());
                $prePay->pay_state = 1;
                $prePay->save();
                //更新余额
                $account = $prePay->user->account()->firstOrCreate();
                $account->balance += $amount;
                $account->save();
                //写入交易记录
                $transaction = new UserTransaction();
                $transaction->out_trade_no = $notify->outTradeNo();
                $transaction->type = 1;
                $transaction->account_type = 2;
                $transaction->amount = $amount;
                $transaction->detail = '充值';
                $transaction->pay_type = 'wechatpay';
                $transaction->data = $message;
                $transaction->user()->associate($prePay->uid);
                $transaction->markAsPaid();

                return true;
            }
            return $fail(static::FAIL);
        });
    }
}
