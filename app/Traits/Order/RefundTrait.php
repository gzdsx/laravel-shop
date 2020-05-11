<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/5/10
 * Time: 1:15 上午
 */

namespace App\Traits\Order;


use Alipay\Factory as Alipay;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Response\RefundOrderResponse;

trait RefundTrait
{
    use WechatDefaultConfig;

    /**
     * @param $transaction
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    protected function refundMoney($transaction, $refund)
    {
        if ($transaction->pay_type == 'wechatpay') {
            $res = $this->payment()->refund->byTransactionId(
                $transaction->extra['transaction_id'],
                $refund->refund_no,
                $transaction->extra['total_fee'],
                $refund->refund_amount
            );
            $response = new RefundOrderResponse($res);
            if (!$response->tradeSuccess()) {
                abort(400, $response->errCodeDes());
            }
        }

        if ($transaction->pay_type == 'alipay') {
            Alipay::refund()->sendRequest([
                'trade_no' => $transaction->extra['trade_no'],
                'refund_amount' => $refund->refund_amount,
                'out_request_no' => $refund->refund_no
            ]);
        }
    }
}
