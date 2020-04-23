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
 * Time: 3:30 下午
 */

namespace ChinaPay\Payment;


use ChinaPay\Exception\ChinaPayException;
use ChinaPay\Traits\HasApi;

class Application
{
    use HasApi;
    //前台支付api 生产环境
    protected $prodApi = 'https://payment.chinapay.com/CTITS/service/rest/page/nref/000000000017/0/0/0/0/0';
    //前台支付api 测试环境
    protected $testApi = 'https://newpayment-test.chinapay.com/CTITS/service/rest/page/nref/000000000017/0/0/0/0/0';
    //后台支付api 生产环境
    protected $bgApi = 'https://payment.chinapay.com/CTITS/service/rest/forward/syn/000000000017/0/0/0/0/0';
    //后台支付api 测试环境
    protected $testBgApi = 'https://newpayment-test.chinapay.com/CTITS/service/rest/forward/syn/000000000017/0/0/0/0/0';

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->api = $this->prodApi;
    }

    /**
     * @return $this
     */
    public function prod()
    {
        $this->api = $this->prodApi;
        return $this;
    }

    /**
     * @return $this
     */
    public function test()
    {
        $this->api = $this->testApi;
        return $this;
    }

    /**
     * @return $this
     */
    public function bgPay()
    {
        $this->api = $this->bgApi;
        return $this;
    }

    /**
     * @return $this
     */
    public function testBgPay()
    {
        $this->api = $this->testBgApi;
        return $this;
    }

    /**
     * @throws ChinaPayException
     */
    protected function validateContent()
    {
        if (!isset($this->content['TranDate'])) {
            throw new ChinaPayException('missing TranDate value', 400);
        }

        if (!isset($this->content['TranTime'])) {
            throw new ChinaPayException('missing TranTime value', 400);
        }

        if (!isset($this->content['MerPageUrl'])) {
            throw new ChinaPayException('missing MerPageUrl value', 400);
        }

        if (!isset($this->content['MerBgUrl'])) {
            throw new ChinaPayException('missing MerBgUrl value', 400);
        }

        if (!isset($this->content['OrderAmt'])) {
            throw new ChinaPayException('missing OrderAmt value', 400);
        }

        if (!isset($this->content['RemoteAddr'])) {
            throw new ChinaPayException('missing RemoteAddr value', 400);
        }
    }
}
