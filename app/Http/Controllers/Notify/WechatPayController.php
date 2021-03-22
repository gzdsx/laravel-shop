<?php

namespace App\Http\Controllers\Notify;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\Transaction;
use App\Services\Contracts\OrderServiceInterface;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Notify\PaidNotify;
use App\WeChat\Notify\RefundNotify;
use EasyWeChat\Kernel\Support\XML;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WechatPayController extends Controller
{
    use WechatDefaultConfig;

    const SUCCESS = 'SUCCESS';
    const FAIL = 'FAIL';

    public function paid(Request $request, $appid)
    {
        return $this->payment($appid)->handlePaidNotify(function ($message, $fail) {
            Storage::put('wxpay', json_encode($message));
            $notify = new PaidNotify($message);
            if ($notify->tradeSuccess()) {
                $transaction = Transaction::findByOutTradeNo($notify->outTradeNo());
                if ($transaction) {
                    if ($transaction->pay_state == 0) {
                        $transaction->pay_state = 1;
                        $transaction->pay_at = now();
                        $transaction->pay_type = 'wechatpay';
                        $transaction->data = $message;
                        $transaction->save();
                        if ($transaction->order) {
                            app(OrderServiceInterface::class)->paid($transaction->order);
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
    public function refund(Request $request, $appid)
    {
        //$data = XML::parse(strval($request->getContent()));
        return $this->payment($appid)->handleRefundedNotify(function ($message, $reqInfo, $fail) {
            $notify = new RefundNotify($message);
            if ($notify->tradeSuccess()) {
                if ($refund = Refund::findByRefundNo($notify->outRefundNo())) {
                    $refund->refund_state = 4;
                    $refund->save();
                    if ($order = $refund->order) {
                        $order->refund_state = 2;
                        $order->refund_at = now();
                        $order->order_state = 5;
                        $order->closed = 1;
                        $order->closed_at = now();
                        $order->save();
                    }
                }
                return true;
            }

            return $fail(static::FAIL);
        });
    }
}
