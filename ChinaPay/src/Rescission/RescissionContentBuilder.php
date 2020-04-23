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
 * Time: 6:04 下午
 */

namespace ChinaPay\Rescission;


use ChinaPay\Content\ContentBuilder;

class RescissionContentBuilder extends ContentBuilder
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
        'TranType' => '9905',
        'OriTranType' => '9904',
        'CardTranData' => '',
        'TranReserved' => '',
        'TimeStamp' => '',
        'RemoteAddr' => ''
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
    public function setOriTranType($value)
    {
        $this->content['OriTranType'] = $value;
        return $this;
    }
}
