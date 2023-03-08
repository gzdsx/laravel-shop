<?php

namespace App\Http\Controllers\Notify\Wechat;

use App\Events\Order\OrderPaid;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Refund;
use App\Models\UserPrepay;
use App\Models\UserTransaction;
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
    public function paid(Request $request, $appName)
    {
        return $this->payment($appName)->handlePaidNotify(function ($message, $fail) {
            $notify = new PaidNotify($message);
            if ($notify->tradeSuccess()) {
                $order = Order::whereOutTradeNo($notify->outTradeNo())->first();
                if ($order->isUnPaid()) {
                    $order->markAsPaid();
                    event(new OrderPaid($order));
                }

                $prepay = UserPrepay::whereOutTradeNo($notify->outTradeNo())->first();
                $transaction = new UserTransaction();
                $transaction->out_trade_no = $notify->outTradeNo();
                $transaction->type = 2;
                $transaction->account_type = 1;
                $transaction->pay_type = 'wechatpay';
                $transaction->amount = $notify->totalFee();
                $transaction->detail = $prepay->data['body'] ?? '';
                $transaction->user()->associate($prepay->uid);
                $transaction->data = $notify->all();
                $transaction->markAsPaid();

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
