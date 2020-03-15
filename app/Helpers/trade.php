<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/3/15
 * Time: 2:07 下午
 */

/**
 * 生成订单号
 * @param string $prefix
 * @return string
 */
function createOrderNo($prefix = '6')
{
    return $prefix . time() . substr(microtime(), 2, 6) . rand(0, 9);
}

/**
 * 生成交易流水号
 * @return string
 */
function createTransactionNo()
{
    return date('YmdHis') . rand(100, 999) . rand(100, 999);
}

/**
 * @return string
 */
function createReundNo()
{
    return '1' . time() . rand(10, 99) . rand(100, 999);
}
