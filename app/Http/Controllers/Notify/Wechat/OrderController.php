<?php

namespace App\Http\Controllers\Notify\Wechat;

use App\Events\Order\OrderPaid;
use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\UserTransaction;
use App\Models\UserAccount;
use App\Models\UserCoinLog;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Notify\PaidNotify;
use App\WeChat\Notify\RefundNotify;
use Illuminate\Http\Request;

class OrderController extends Controller
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
    public function paid(Request $request)
    {
        return $this->payment()->handlePaidNotify(function ($message, $fail) {
            $notify = new PaidNotify($message);
            if ($notify->tradeSuccess()) {
                $transaction = UserTransaction::findByOutTradeNo($notify->outTradeNo());
                if ($transaction) {
                    if ($transaction->isUnPaid()) {
                        $transaction->forceFill([
                            'pay_type' => 'wechatpay',
                            'data' => $message
                        ])->markAsPaid();

                        if ($order = $transaction->order) {
                            $order->markAsPaid();

                            event(new OrderPaid($order));
                        }
                    }
                }
                return true;
            }
            return $fail(static::FAIL);
        });
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\Exception
     */
    public function refund(Request $request)
    {
        return $this->payment()->handleRefundedNotify(function ($message, $reqInfo, $fail) {
            $notify = new RefundNotify($message);
            if ($notify->tradeSuccess()) {
                if ($refund = Refund::findByRefundNo($notify->outRefundNo())) {
                    $refund->refund_state = 4;
                    $refund->save();
                    if ($order = $refund->order) {
                        $order->markAsRefunded();
                    }
                }
                return true;
            }

            return $fail(static::FAIL);
        });
    }
}
