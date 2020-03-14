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

namespace App\Traits\Wechat;

use App\Models\Order;
use App\Traits\Common\AuthenticatedUser;
use App\WeChat\Order\UnifiedOrder;
use App\WeChat\Response\UnifiedOrderResponse;
use App\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;

trait WechatPayManagers
{
    use AuthenticatedUser, WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function getPayConfig(Request $request)
    {


        $appid = $request->input('appid');
        $openid = $request->input('openid');
        if (!$appid){
            $appid = $this->user()->connects()->where('openid',$openid)->first()->appid;
        }
        $payment = $this->payment($appid);

        $order_id = $request->input('order_id');
        $order = Order::find($order_id);
        $transaction = $order->transaction;

        $unifiedOrder = new UnifiedOrder();
        $unifiedOrder->setBody($transaction->detail)
            ->setOutTradeNo($transaction->out_trade_no)
            ->setTotalFee($transaction->amount * 100)
            ->setOpenid($openid)
            ->setTradeType($payment->config->get('trade_type', 'JSAPI'))
            ->setNotifyUrl($payment->config->get('notify_url'));

        $res = new UnifiedOrderResponse($payment->order->unify($unifiedOrder->getBizContent()));
        if ($res->tradeSuccess()) {
            $transaction->prepay_id = $res->prepayId();
            $transaction->save();

            return $this->sendConfigResponse($request, $res, $payment);
        } else {
            return $this->sendConfigFailedResponse($request, $res);
        }
    }

    /**
     * @param UnifiedOrderResponse $unifiedResponse
     * @param \EasyWeChat\Payment\Application $payment
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendConfigResponse(Request $request, UnifiedOrderResponse $unifiedResponse, $payment)
    {
        return ajaxReturn(['config' => $payment->jssdk->bridgeConfig($unifiedResponse->prepayId(), false)]);
    }

    /**
     * @param Request $request
     * @param UnifiedOrderResponse $unifiedResponse
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendConfigFailedResponse(Request $request, UnifiedOrderResponse $unifiedResponse)
    {
        return ajaxError(400, $unifiedResponse->errCodeDes(), ['extra'=>$unifiedResponse->all()]);
    }
}
