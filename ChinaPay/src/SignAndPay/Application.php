<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/24
 * Time: 9:05 下午
 */

namespace ChinaPay\SignAndPay;


use ChinaPay\Traits\HasApi;

class Application
{
    use HasApi;

    //前台支付
    protected $prodApi = "https://payment.chinapay.com/CTITS/service/rest/page/nref/000000000017/0/0/0/0/0";
    protected $testApi = "https://newpayment-test.chinapay.com/CTITS/service/rest/page/nref/000000000017/0/0/0/0/0";
    //后台支付
    protected $bgApi = "https://payment.chinapay.com/CTITS/service/rest/forward/syn/000000000017/0/0/0/0/0";
    protected $testBgApi = "https://newpayment-test.chinapay.com/CTITS/service/rest/forward/syn/000000000017/0/0/0/0/0";

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
    public function bgPay(){
        $this->api = $this->bgApi;
        return $this;
    }

    /**
     * @return $this
     */
    public function testBgPay(){
        $this->api = $this->bgApi;
        return $this;
    }
}
