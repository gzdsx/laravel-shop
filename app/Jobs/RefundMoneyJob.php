<?php

namespace App\Jobs;

use Alipay\Factory as Alipay;
use App\Models\Refund;
use App\Models\UserTransaction;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Response\RefundOrderResponse;
use EasyWeChat\Kernel\Exceptions\InvalidConfigException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefundMoneyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use WechatDefaultConfig;

    protected $refund;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Refund $refund)
    {
        $this->refund = $refund;
    }


    public function handle()
    {
        try {
            $this->refundMoney();
        } catch (InvalidConfigException $exception) {

        }
    }

    /**
     * @param UserTransaction $transaction
     * @param Refund $refund
     * @return array|bool|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws InvalidConfigException
     */
    protected function refundMoney()
    {
        $refund = $this->refund;
        $order = $refund->order;
        if (!$order) return false;

        if ($transaction = $order->transaction) {
            if ($transaction->pay_type == 'wechatpay') {
                $refund_amount = $refund->refund_amount;
                $refund_amount > $transaction->extra['total_fee'] && $refund_amount = $transaction->extra['total_fee'];
                $res = $this->payment()->refund->byTransactionId(
                    $transaction->extra['transaction_id'],
                    $refund->refund_no,
                    $transaction->extra['total_fee'],
                    $refund->refund_amount,
                    [
                        'notify_url' => url('notify/wechat/refund')
                    ]
                );
                $response = new RefundOrderResponse($res);
                if ($response->tradeSuccess()) {
                    return $response->all();
                } else {
                    abort(400, $response->errCodeDes());
                    return false;
                }
            }

            if ($transaction->pay_type == 'alipay') {
                $refund_amount = $refund->refund_amount;
                $refund_amount > $transaction->extra['total_amount'] && $refund_amount = $transaction->extra['total_amount'];
                $res = Alipay::refund()->sendRequest([
                    'trade_no' => $transaction->extra['trade_no'],
                    'refund_amount' => $refund_amount,
                    'out_request_no' => $refund->refund_no
                ]);
                return $res;
            }
        }

        return false;
    }
}
