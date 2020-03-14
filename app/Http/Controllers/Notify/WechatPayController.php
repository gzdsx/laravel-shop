<?php

namespace App\Http\Controllers\Notify;

use App\Events\OrderEvent;
use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\WeChat\Response\QueryOrderResponse;
use App\WeChat\Response\WechatPayResponse;
use App\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatPayController extends Controller
{
    use XmlToArrayTrait, WechatDefaultConfig;

    protected $transactionRepository;
    public function __construct(Request $request, TransactionRepositoryInterface $transactionRepository)
    {
        parent::__construct($request);
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @param Request $request
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function index(Request $request)
    {
        $xml = $request->getContent();
        $response = new WechatPayResponse($this->xmlToArray($xml));


        if ($response->tradeSuccess()){
            $queryRes = new QueryOrderResponse($this->payment($response->appid())->order->queryByOutTradeNumber($response->outTradeNo()));
            if ($queryRes->tradeSuccess()) {
                $transaction = Transaction::where('out_trade_no', $response->outTradeNo())->first();
                if ($transaction){
                    if (!$transaction->pay_state) {
                        $transaction->pay_state = 1;
                        $transaction->pay_at = time();
                        $transaction->pay_type = 'wechatpay';
                        $transaction->pay_appid = $response->appid();
                        $transaction->transaction_state = 2;
                        $transaction->save();

                        $order = $transaction->order;
                        if ($order)
                        {
                            $order->pay_state = 1;
                            $order->pay_at = time();
                            $order->order_state = 2;
                            $order->save();

                            event(new OrderEvent($order, 'paid'));
                            $this->sendTemplateMessage($queryRes, $order, $transaction);
                        }
                    }
                }
            }
        }
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
            'page' => 'pages/bought/detail?order_id='.$order->order_id,
            'form_id' => $transaction->prepayId->prepay_id,
            'data' => [
                'keyword1' => $order->order_no,
                'keyword2' => @date('Y-m-d H:i:s'),
                'keyword3' => $transaction->subject,
                'keyword4' => formatAmount($response->totalFee()/100).'元',
                'keyword5' => '您的商品很快就飞奔到您手上咯！',
                // ...
            ]
        ]);

        return $res;
    }
}
