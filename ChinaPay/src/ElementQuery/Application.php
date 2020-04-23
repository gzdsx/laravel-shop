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
 * Time: 11:36 下午
 */

namespace ChinaPay\ElementQuery;


use ChinaPay\Exception\ChinaPayException;
use ChinaPay\Traits\HasApi;

class Application
{
    use HasApi;
    //生产环境api
    protected $prodApi = 'https://payment.chinapay.com/CTITS/service/rest/forward/syn/000000000017/0/0/0/0/0';
    //测试环境api
    protected $testApi = 'https://newpayment-test.chinapay.com/CTITS/service/rest/forward/syn/000000000017/0/0/0/0/0';

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
     * @throws ChinaPayException
     */
    protected function validateContent()
    {
        if (!isset($this->content['OriTranType'])) {
            throw new ChinaPayException('missing OriTranType value', 400);
        }

        if (!isset($this->content['CardTranData'])) {
            throw new ChinaPayException('missing CardTranData value', 400);
        }
    }
}
