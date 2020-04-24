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
 * Time: 8:56 下午
 */

namespace ChinaPay\PaySms;


use ChinaPay\Content\ContentBuilder;

class PaySmsContentBuilder extends ContentBuilder
{

    protected $content = [
        'Version' => '20150922',
        'AccessType' => 0,
        'InstuId' => '',
        'AcqCode' => '',
        'MerId' => '',
        'TranType' => '0606',
        'BusiType' => '0001',
        'MerOrderNo'=>'',
        'TranDate'=>'',
        'TranTime'=>'',
        'OrderAmt'=>'',
        'CardTranData'=>''
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
     * 设置订单金额，单位分
     * @param $value
     * @return $this
     */
    public function setOrderAmt($value)
    {
        $this->content['OrderAmt'] = $value;
        return $this;
    }
}
