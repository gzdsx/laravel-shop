<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/6/14
 * Time: 下午5:54
 */

namespace Alipay\Builder;


class AlipayPagePayContentBuilder extends AlipayContentBuilder
{
    protected $bizContent = [
        'out_trade_no'=>'',//订单号
        'total_amount'=>'',//订单金额
        'subject'=>'',//商品名称
        'body'=>''//商品描述
    ];

    /**
     * @return null
     */
    public function getOutTradeNo()
    {
        return $this->bizContent['out_trade_no'];
    }

    /**
     * @param null $outTradeNo
     * @return AlipayPagePayContentBuilder
     */
    public function setOutTradeNo($outTradeNo)
    {
        $this->bizContent['out_trade_no'] = $outTradeNo;
        return $this;
    }

    /**
     * @return null
     */
    public function getTotalAmount()
    {
        return $this->bizContent['total_amount'];
    }

    /**
     * @param null $totalAmount
     * @return AlipayPagePayContentBuilder
     */
    public function setTotalAmount($totalAmount)
    {
        $this->bizContent['total_amount'] = $totalAmount;
        return $this;
    }

    /**
     * @return null
     */
    public function getSubject()
    {
        return $this->bizContent['subject'];
    }

    /**
     * @param null $subject
     * @return AlipayPagePayContentBuilder
     */
    public function setSubject($subject)
    {
        $this->bizContent['subject'] = $subject;
        return $this;
    }

    /**
     * @return null
     */
    public function getBody()
    {
        return $this->bizContent['body'];
    }

    /**
     * @param null $body
     * @return AlipayPagePayContentBuilder
     */
    public function setBody($body)
    {
        $this->bizContent['body'] = $body;
        return $this;
    }
}
