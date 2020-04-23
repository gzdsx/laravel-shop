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
 * Time: 5:44 下午
 */

namespace ChinaPay\Signing;


use ChinaPay\Content\ContentBuilder;

class SignContentBuilder extends ContentBuilder
{

    protected $content = [
        'Version' => '20150922',
        'AccessType' => 0,
        'InstuId' => '',
        'AcqCode' => '',
        'MerId' => '',
        'MerOrderNo' => '',
        'TranDate' => '',
        'TranTime' => '',
        'BusiType' => '0001',
        'CurryNo' => '',
        'TranType' => '9904',
        'MerPageUrl' => '',
        'MerBgUrl' => '',
        'TimeStamp' => '',
        'RemoteAddr' => '',
        'MerResv' => '',
        'TranReserved' => '',
        'CardTranData' => '',
        'RiskData' => ''
    ];

    /**
     * 设置商户订单号
     * @param $value
     * @return $this
     */
    public function setMerOrderNo($value)
    {
        $this->content['MerOrderNo'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setTranDate($value)
    {
        $this->content['TranDate'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setTranTime($value)
    {
        $this->content['TranTime'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMerBgUrl($value)
    {
        $this->content['MerBgUrl'] = $value;
        return $this;
    }
}
