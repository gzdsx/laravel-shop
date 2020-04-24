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
 * Time: 2:25 下午
 */

namespace ChinaPay\SignSms;


use ChinaPay\Exception\ChinaPayException;
use ChinaPay\Traits\HasApi;

class Application
{
    use HasApi;

    protected $prodApi = "https://payment.chinapay.com/CTITS/service/rest/forward/syn/000000000017/0/0/0/0/0";
    protected $testApi = "https://newpayment-test.chinapay.com/CTITS/service/rest/forward/syn/000000000017/0/0/0/0/0";

    public function __construct()
    {
        $this->api = $this->prodApi;
    }

    public function prod()
    {
        $this->api = $this->prodApi;
        return $this;
    }

    public function test()
    {
        $this->api = $this->testApi;
        return $this;
    }

    /**
     * @throws ChinaPayException
     */
    protected function validateContent()
    {
        if (!isset($this->content['MerOrderNo'])) {
            throw new ChinaPayException('missing MerOrderNo value', 400);
        }

        if (!isset($this->content['TranDate'])) {
            throw new ChinaPayException('missing TranDate value', 400);
        }

        if (!isset($this->content['TranTime'])) {
            throw new ChinaPayException('missing TranTime value', 400);
        }

        if (!isset($this->content['CardTranData'])) {
            throw new ChinaPayException('missing CardTranData value', 400);
        }
    }
}
