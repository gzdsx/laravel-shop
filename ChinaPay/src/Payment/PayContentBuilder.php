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
 * Time: 3:20 下午
 */

namespace ChinaPay\Payment;


use ChinaPay\Content\ContentBuilder;

class PayContentBuilder extends ContentBuilder
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
        'OrderAmt' => '',
        'TranType' => '',
        'BusiType' => '0001',
        'CurryNo' => 'CNY',
        'SplitType' => '0001',
        'SplitMethod' => 0,
        'MerSplitMsg' => '',
        'BankInstNo' => '',
        'MerPageUrl' => '',
        'MerBgUrl' => '',
        'CommodityMsg' => '',
        'MerResv' => '',
        'TranReserved' => '',
        'CardTranData' => '',
        'Term' => '',
        'PayTimeOut' => '',
        'TimeStamp' => '',
        'RemoteAddr' => '',
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
     * 设置订单金额，单位分
     * @param $value
     * @return $this
     */
    public function setOrderAmt($value)
    {
        $this->content['OrderAmt'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMerPageUrl($value)
    {
        $this->content['MerPageUrl'] = $value;
        return $this;
    }

    /**
     * 设置后台通知地址
     * @param $value
     * @return $this
     */
    public function setMerBgUrl($value)
    {
        $this->content['MerBgUrl'] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setRemoteAddr($value)
    {
        $this->content['RemoteAddr'] = $value;
        return $this;
    }
}
