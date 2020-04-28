<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/28
 * Time: 2:09 上午
 */

namespace Alipay\Application;


class RefundQueryApplication extends AlipayApplication
{
    /**
     * 退款查询，必填参数:out_request_no
     * @param $bizContent
     * @return array
     */
    public function sendRequest($bizContent)
    {
        $this->setBizContent($bizContent);
        $this->setMethod('alipay.trade.fastpay.refund.query');
        $this->makeSign();;
        $response = $this->postData($this->params);
        return $response['alipay_trade_fastpay_refund_query_response'];
    }
}
