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
 * Time: 2:05 上午
 */

namespace Alipay\Application;


class QueryApplication extends AlipayApplication
{

    /**
     * 订单查询, 参数:trade_no||out_trade_no
     * @param $payContent
     * @return array
     */

    public function sendRequest($bizContent)
    {
        $this->setBizContent($bizContent);
        $this->setMethod('alipay.trade.query');
        $this->makeSign();
        $response = $this->postData($this->params);
        return $response['alipay_trade_query_response'];
    }
}
