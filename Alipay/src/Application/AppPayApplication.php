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
 * Time: 2:01 上午
 */

namespace Alipay\Application;


class AppPayApplication extends AlipayApplication
{

    /**
     * App 支付, 必填参数：subject, out_trade_no, total_amount,
     * @param $payContent
     * @return array
     */
    public function sendRequest($bizContent)
    {
        if (is_object($bizContent)) {
            $bizContent->product_code = 'QUICK_MSECURITY_PAY';
        } else {
            $bizContent['product_code'] = 'QUICK_MSECURITY_PAY';
        }
        $this->setBizContent($bizContent);
        $this->setMethod('alipay.trade.app.pay');
        $this->makeSign();
        return $this->params;
    }
}
