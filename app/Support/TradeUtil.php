<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/18
 * Time: 8:07 下午
 */

namespace App\Support;


class TradeUtil
{
    /**
     * 生成订单号
     * @return string
     */
    public static function createOrderNo($prefix = '')
    {
        return $prefix . date('YmdHis') . rand(100, 999) . rand(100, 999);
    }

    public static function createOutTradeNo($prefix = '')
    {
        return $prefix . date('YmdHis') . rand(100, 999) . rand(100, 999);
    }

    /**
     * 生成退货单号
     * @return string
     */
    public static function createReundNo()
    {
        return '1' . time() . rand(10, 99) . rand(100, 999);
    }
}
