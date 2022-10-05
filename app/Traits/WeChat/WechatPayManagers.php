<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/10/26
 * Time: 12:18 AM
 */

namespace App\Traits\WeChat;


use App\Models\Order;
use App\Models\WechatPrePay;
use App\Support\TradeUtil;
use App\WeChat\Order\UnifiedOrder;
use App\WeChat\Response\UnifiedOrderResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait WechatPayManagers
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function unify(Request $request)
    {

        $app = $request->input('app') ?: 'default';
        $payment = $app ? $this->payment($app) : $this->payment();

        $openid = $request->input('openid', session('wechat_oauth_user.openid')) ?: $request->header('openid');
        if (!$openid) {
            abort(500, 'missing openid value');
        }

        $order = Order::findOrFail($request->input('order_id'));
        if ($order->pay_state) {
            abort(500, trans('trade.order paid'));
        }

        if (!$transaction = $order->transaction) {
            abort(500, 'missing order transaction');
        }

        $unifiedOrder = new UnifiedOrder();
        $unifiedOrder->setBody($transaction->detail)
            ->setOutTradeNo($transaction->out_trade_no)
            ->setTotalFee($transaction->amount * 100)
            ->setTotalFee(1)
            ->setOpenid($openid)
            ->setTradeType($payment->config->get('trade_type', 'JSAPI'))
            ->setNotifyUrl('/notify/wechat/order/paid/' . $app);
        //return jsonSuccess($unifiedOrder->all());
        $res = new UnifiedOrderResponse($payment->order->unify($unifiedOrder->getBizContent()));
        //解决订单号重复问题
        if ($res->errCode() === 'INVALID_REQUEST') {
            $transaction->out_trade_no = TradeUtil::createTransactionNo();
            $transaction->save();

            $unifiedOrder->setOutTradeNo($transaction->out_trade_no);
            $res = new UnifiedOrderResponse($payment->order->unify($unifiedOrder->getBizContent()));
        }
        if ($res->tradeSuccess()) {
            $prepay = WechatPrePay::firstOrNew(['out_trade_no' => $unifiedOrder->getOutTradeNo()]);
            $prepay->uid = Auth::id();
            $prepay->order_id = $order->order_id;
            $prepay->prepay_id = $res->prepayId();
            $prepay->data = $unifiedOrder->all();
            $prepay->save();

            return $this->sendUnifiedOrderResponse($request, $payment, $res);
        } else {
            return $this->sendUnifiedOrderFailedResponse($request, $payment, $res);
        }
    }

    /**
     * @param Request $request
     * @param \EasyWeChat\Payment\Application $payment
     * @param UnifiedOrderResponse $unifiedResponse
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendUnifiedOrderResponse(Request $request, $payment, UnifiedOrderResponse $unifiedResponse)
    {
        return jsonSuccess(['config' => $payment->jssdk->bridgeConfig($unifiedResponse->prepayId(), false)]);
    }

    /**
     * @param Request $request
     * @param \EasyWeChat\Payment\Application $payment
     * @param UnifiedOrderResponse $unifiedResponse
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendUnifiedOrderFailedResponse(Request $request, $payment, UnifiedOrderResponse $unifiedResponse)
    {
        return jsonError(500, $unifiedResponse->errCodeDes() ?: $unifiedResponse->retrunMsg(), ['extra' => $unifiedResponse->all()]);
    }
}
