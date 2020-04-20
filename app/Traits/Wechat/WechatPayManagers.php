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


use App\Models\Transaction;
use App\Models\UserConnect;
use App\WeChat\Order\UnifiedOrder;
use App\WeChat\Response\UnifiedOrderResponse;
use App\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;

trait WechatPayManagers
{
    use WechatDefaultConfig;

    /**
     * @return string
     */
    protected function configName()
    {
        return 'default';
    }

    /**
     * @param Transaction $transaction
     * @param $openid
     * @return UnifiedOrderResponse|\Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPayConfig(Request $request)
    {
        $transaction = Transaction::findOrFail($request->input('transaction_id'));
        $openid = session('wechat_user.openid');
        if (!$openid){
            $connect = UserConnect::where('uid', $transaction->payer_uid)->first();
            if ($connect) {
                $openid = $connect->openid;
            } else {
                abort(400, 'missing openid value');
            }
        }

        $payment = $this->payment($this->configName());
        $unifiedOrder = new UnifiedOrder();
        $unifiedOrder->setBody($transaction->detail)
            ->setOutTradeNo($transaction->out_trade_no)
            ->setTotalFee($transaction->amount * 100)
            ->setOpenid($openid)
            ->setTradeType($payment->config->get('trade_type', 'JSAPI'))
            ->setNotifyUrl($payment->config->get('notify_url'));

        //$unifiedOrder = $this->test();
        $res = new UnifiedOrderResponse($payment->order->unify($unifiedOrder->getBizContent()));
        if ($res->tradeSuccess()) {
            return $this->sendConfigResponse($request, $payment, $res);
        } else {
            return $this->sendConfigFailedResponse($request, $payment, $res);
        }
    }

    protected function testUnifiedOrder()
    {
        $payment = $this->payment($this->configName());
        $unifiedOrder = new UnifiedOrder();
        $unifiedOrder->setBody('订单支付测试')
            ->setOutTradeNo(time())
            ->setTotalFee(1)
            ->setOpenid('orT_zvy-cnPpKsKr_HDLaLWvAL6w')
            ->setTradeType($payment->config->get('trade_type', 'JSAPI'))
            ->setNotifyUrl($payment->config->get('notify_url'));
        return $unifiedOrder;
    }

    /**
     * @param Request $request
     * @param \EasyWeChat\Payment\Application $payment
     * @param UnifiedOrderResponse $unifiedResponse
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendConfigResponse(Request $request, $payment, UnifiedOrderResponse $unifiedResponse)
    {
        return ajaxReturn(['config' => $payment->jssdk->bridgeConfig($unifiedResponse->prepayId(), false)]);
    }

    /**
     * @param Request $request
     * @param \EasyWeChat\Payment\Application $payment
     * @param UnifiedOrderResponse $unifiedResponse
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendConfigFailedResponse(Request $request, $payment, UnifiedOrderResponse $unifiedResponse)
    {
        dd($unifiedResponse);
        return ajaxError(400, $unifiedResponse->errCodeDes(), ['extra' => $unifiedResponse->all()]);
    }
}
