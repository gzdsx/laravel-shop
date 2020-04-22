<?php

namespace App\Http\Controllers\Notify;

use App\Events\OrderEvent;
use App\Models\Transaction;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Response\QueryOrderResponse;
use App\WeChat\Response\WechatPayResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatPayController extends Controller
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\Exception
     */
    public function index(Request $request)
    {
        $response = $this->payment()->handlePaidNotify(function ($message, $fail) {
            @file_put_contents(storage_path('pay.php'), json_encode($message));
            $res = new WechatPayResponse($message);
            if ($res->tradeSuccess()) {
                $transaction = Transaction::where('out_trade_no',$res->outTradeNo())->first();
                if ($transaction){
                    if ($transaction->pay_state == 0){
                        $transaction->transaction_state = 2;
                        $transaction->pay_state = 1;
                        $transaction->pay_at = now();
                        $transaction->pay_type = 'wechatpay';
                        $transaction->extra = $res->all();
                        $transaction->save();
                        if ($transaction->order){
                            $transaction->order->order_state = 2;
                            $transaction->order->pay_state = 1;
                            $transaction->order->pay_at = now();
                            $transaction->order->save();
                            event(new OrderEvent($transaction->order, 'paid'));
                        }
                    }
                }
            }
        });
        return $response;
    }

    /**
     * @param QueryOrderResponse $response
     * @param $order
     * @param $transaction
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    private function sendTemplateMessage(QueryOrderResponse $response, $order, $transaction)
    {
        $res = $this->miniProgram()->template_message->send([
            'touser' => $response->openid(),
            'template_id' => 'roTzzH27Tyl3dFCNG2MM7yRfMG-zrFYD0tO1XTwPM10',
            'page' => 'pages/bought/detail?order_id=' . $order->order_id,
            'form_id' => $transaction->prepayId->prepay_id,
            'data' => [
                'keyword1' => $order->order_no,
                'keyword2' => @date('Y-m-d H:i:s'),
                'keyword3' => $transaction->subject,
                'keyword4' => formatAmount($response->totalFee() / 100) . '元',
                'keyword5' => '您的商品很快就飞奔到您手上咯！',
                // ...
            ]
        ]);

        return $res;
    }
}
