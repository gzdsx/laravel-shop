<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/12
 * Time: 2:59 下午
 */

namespace ChinaPay;

/**
 * Class Factory
 * @package ChinaPay
 *
 * @method static \ChinaPay\Payment\Application payment() 支付
 * @method static \ChinaPay\PaySms\Application paySms() 支付短信
 * @method static \ChinaPay\Query\Application query() 查询
 * @method static \ChinaPay\ElementQuery\Application elementQuery() 要素查询
 * @method static \ChinaPay\Signing\Application signing() 签约
 * @method static \ChinaPay\SignQuery\Application signQuery() 签约查询
 * @method static \ChinaPay\Rescission\Application rescission() 解约
 * @method static \ChinaPay\SignSms\Application signSms() 签约短信
 * @method static \ChinaPay\SignAndPay\Application signAndPay() 签约并支付
 */
class Factory
{
    private static $appMap = [
        'payment' => \ChinaPay\Payment\Application::class,
        'paySms' => \ChinaPay\PaySms\Application::class,
        'query' => \ChinaPay\Query\Application::class,
        'elementQuery' => \ChinaPay\ElementQuery\Application::class,
        'signing' => \ChinaPay\Signing\Application::class,
        'signQuery' => \ChinaPay\SignQuery\Application::class,
        'rescission' => \ChinaPay\Rescission\Application::class,
        'signSms' => \ChinaPay\SignSms\Application::class,
        'signAndPay' => \ChinaPay\SignAndPay\Application::class,
    ];

    /**
     * @param $name
     * @param array $config
     * @return mixed
     */
    public static function make($name)
    {
        $application = self::$appMap[$name];

        return new $application();
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
