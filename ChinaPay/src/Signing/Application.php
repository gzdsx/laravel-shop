<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/13
 * Time: 5:51 下午
 */

namespace ChinaPay\Signing;


use ChinaPay\Exception\ChinaPayException;
use ChinaPay\Traits\HasApi;

class Application
{
    use HasApi;
    //生产环境api 前台
    protected $prodApi = 'https://payment.chinapay.com/CTITS/service/rest/page/nref/000000000017/0/0/0/0/0';
    //生产环境api 后台
    protected $bgApi = 'https://payment.chinapay.com/CTITS/service/rest/forward/syn/000000000017/0/0/0/0/0';
    //测试环境api 前台
    protected $testApi = 'https://newpayment-test.chinapay.com/CTITS/service/rest/page/nref/000000000017/0/0/0/0/0';
    //测试环境api 后台
    protected $bgTestApi = 'https://newpayment-test.chinapay.com/CTITS/service/rest/forward/syn/000000000017/0/0/0/0/0';

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
    public function bgSigning()
    {
        $this->api = $this->bgApi;
        return $this;
    }

    /**
     * @return $this
     */
    public function testBgSigning()
    {
        $this->api = $this->bgTestApi;
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

        if (!isset($this->content['MerBgUrl'])) {
            throw new ChinaPayException('missing MerBgUrl value', 400);
        }

        if (!isset($this->content['MerOrderNo'])) {
            throw new ChinaPayException('missing MerOrderNo value', 400);
        }

        if (!isset($this->content['CardTranData'])) {
            throw new ChinaPayException('missing CardTranData value', 400);
        }
    }
}
