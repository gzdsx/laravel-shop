<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-24
 * Time: 18:37
 */

namespace App\Services\Wechat;


use App\Services\Contracts\WechatPayServiceInterface;
use App\WeChat\Order\UnifiedOrder;
use App\WeChat\Response\UnifiedOrderResponse;

class WechatPayService implements WechatPayServiceInterface
{
    /**
     * @param \App\Models\Order $order
     * @param \EasyWeChat\Payment\Application $payment
     * @param string $openid
     * @return UnifiedOrderResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function unifiedOrder($order, $payment, $openid)
    {
        // TODO: Implement unifiedOrder() method.
        $transaction = $order->transaction;

        $unifiedOrder = new UnifiedOrder();
        $unifiedOrder->setBody($transaction->subject)
            ->setOutTradeNo($transaction->out_trade_no)
            ->setTotalFee($transaction->amount * 100)
            ->setOpenid($openid)
            ->setTradeType($payment->config->get('trade_type', 'JSAPI'))
            ->setNotifyUrl($payment->config->get('notify_url'));
        //return $unifiedOrder->getBizContent();
        return new UnifiedOrderResponse($payment->order->unify($unifiedOrder->getBizContent()));
    }
}
