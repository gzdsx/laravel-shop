<?php

namespace App\Http\Controllers\Notify;

use App\Http\Controllers\Controller;
use App\Models\BuyLog;
use App\Models\Live;
use App\Models\PrePay;
use App\Models\Transaction;
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
     */
    public function onPublish(Request $request)
    {
        Storage::put('on_publish', json_encode($request->all()));
        Live::where('stream_id', $request->input('name'))->update(['state' => 1]);
    }

    /**
     * @param Request $request
     */
    public function onPublishDone(Request $request)
    {
        Storage::put('on_publish_done', json_encode($request->all()));
        Live::where('stream_id', $request->input('name'))->update(['state' => 2]);
    }

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
                $prepay = PrePay::find($notify->outTradeNo());
                if ($prepay) {
                    $transaction = Transaction::firstOrNew(['out_trade_no' => $notify->outTradeNo()]);
                    $transaction->transaction_type = 'ticket';
                    $transaction->payer_id = $prepay->uid;
                    $transaction->payer_name = $prepay->username;
                    $transaction->pay_type = 'wechatpay';
                    $transaction->pay_state = 1;
                    $transaction->pay_at = now();
                    $transaction->subject = $prepay->data['body'] ?? '';
                    $transaction->amount = $notify->totalFee();
                    $transaction->data = $message;
                    $transaction->save();

                    $buyLog = BuyLog::find($notify->attach());
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
