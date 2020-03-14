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
 * Time: 18:34
 */

namespace App\Services\Contracts;


use App\WeChat\Response\UnifiedOrderResponse;

interface WechatPayServiceInterface
{
    /**
     * @param \App\Models\Order $order
     * @param \EasyWeChat\Payment\Application $payment
     * @param string $openid
     * @return UnifiedOrderResponse
     */
    public function unifiedOrder($order, $payment, $openid);
}
