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
 * Time: 11:49 下午
 */

namespace ChinaPay\Query;


use ChinaPay\Content\ContentBuilder;

class QueryContentBuilder extends ContentBuilder
{

    protected $content = [
        'Version' => '20140728',
        'AccessType' => 0,
        'InstuId' => '',
        'AcqCode' => '',
        'MerId' => '',
        'MerOrderNo' => '',
        'TranDate' => '',
        'TranType' => '0502',
        'BusiType' => '0001',
        'TranReserved' => ''
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
    public function setTranReserved($value)
    {
        $this->content['TranReserved'] = $value;
        return $this;
    }
}
