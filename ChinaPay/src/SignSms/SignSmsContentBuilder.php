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
 * Time: 2:28 下午
 */

namespace ChinaPay\SignSms;


use ChinaPay\Content\ContentBuilder;

class SignSmsContentBuilder extends ContentBuilder
{
    protected $content = [
        'Version' => '20150922',
        'AccessType' => '',
        'InstuId' => '',
        'AcqCode' => '',
        'MerId' => '',
        'MerOrderNo' => '',
        'TranDate' => '',
        'TranTime' => '',
        'OrderAmt' => '',
        'BusiType' => '0001',
        'CurryNo' => 'CNY',
        'TranType' => '0608',
        'RemoteAddr' => '',
        'MerResv' => '',
        'TranReserved' => '',
        'CardTranData' => '',
        'TimeStamp' => '',
        'RiskData' => ''
    ];

    /**
     * @param $value
     */
    public function setMerOrderNo($value)
    {
        $this->content['MerOrderNo'] = $value;
    }

    /**
     * @param $value
     */
    public function setTranDate($value)
    {
        $this->content['TranDate'] = $value;
    }

    /***
     * @param $value
     */
    public function setTranTime($value)
    {
        $this->content['TranTime'] = $value;
    }
}
