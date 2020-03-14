<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/6/14
 * Time: 下午5:47
 */

namespace App\Alipay;


class Alipay
{
    /**
     * @param array $config
     * @return AlipayClient
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function pay($condfig = [])
    {
        return new AlipayClient($condfig);
    }
}
