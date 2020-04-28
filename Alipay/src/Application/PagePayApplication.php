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
 * Time: 1:27 上午
 */

namespace Alipay\Application;


class PagePayApplication extends AlipayApplication
{

    /**
     * 网页支付, 必填参数：subject, out_trade_no, total_amount,
     * @param array $bizContent
     * @return array|mixed|string
     */
    public function sendRequest($bizContent)
    {
        if (is_object($bizContent)) {
            $bizContent->product_code = 'FAST_INSTANT_TRADE_PAY';
        } else {
            $bizContent['product_code'] = 'FAST_INSTANT_TRADE_PAY';
        }

        $this->setBizContent($bizContent);
        $this->setMethod('alipay.trade.page.pay');
        $this->makeSign();

        return $this->buildRequestForm();
    }
}
