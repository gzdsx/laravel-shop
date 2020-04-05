<?php

namespace App\Http\Controllers\H5;


use App\Repositories\Contracts\OrderRepositoryInterface;
use App\WeChat\Order\UnifiedOrder;
use App\WeChat\Response\UnifiedOrderResponse;
use Illuminate\Http\Request;

class WechatPayController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['wechat.oauth']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getConfig(Request $request)
    {
        $order_id = $request->input('order_id');
        $order = app(OrderRepositoryInterface::class)->findOrFail($order_id);
        $item = $order->items()->first();

        $payment = $this->payment();
        $unifiedOrder = new UnifiedOrder();
        $unifiedOrder->setBody($item->title)
            ->setOutTradeNo($order->order_no)
            ->setTotalFee($order->total_fee * 100)
            ->setOpenid(session('wechat_user.openid'))
            ->setTradeType($payment->config->get('trade_type', 'JSAPI'))
            ->setNotifyUrl($payment->config->get('notify_url'));

/*        $unifiedOrder->setBody('订单支付测试')
            ->setOutTradeNo(time())
            ->setTotalFee(1)
            ->setOpenid(session('wechat_user.openid'))
            ->setTradeType($payment->config->get('trade_type', 'JSAPI'))
            ->setNotifyUrl($payment->config->get('notify_url'));*/

        $res = new UnifiedOrderResponse($payment->order->unify($unifiedOrder->getBizContent()));
        if ($res->tradeSuccess()) {
            return ajaxReturn(['config' => $payment->jssdk->bridgeConfig($res->prepayId(), false)]);
        } else {
            return ajaxError(400, $res->errCodeDes(), ['extra' => $res->all()]);
        }
    }
}
