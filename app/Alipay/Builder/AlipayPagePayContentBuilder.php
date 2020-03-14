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

namespace App\Alipay\Builder;


class AlipayPagePayContentBuilder
{
    private $bizContent = array(
        'out_trade_no'=>'',//订单号
        'total_amount'=>'',//订单金额
        'subject'=>'',//商品名称
        'body'=>''//商品描述
    );

    public $outTradeNo = null;
    public $totalAmount = null;
    public $subject = null;
    public $body = null;

    /**
     * @return array
     * @throws \Exception
     */
    public function getBizContent(){
        if (!$this->outTradeNo) {
            throw new \Exception('out_trade_no empty', 1);
        } else {
            $this->bizContent['out_trade_no'] = $this->outTradeNo;
        }

        if (!$this->totalAmount) {
            throw new \Exception('total_amount empty', 2);
        } else {
            $this->bizContent['total_amount'] = $this->totalAmount;
        }

        if (!$this->subject) {
            throw new \Exception('subject empty', 3);
        } else {
            $this->bizContent['subject'] = $this->subject;
        }

        if ($this->body) {
            $this->bizContent['body'] = $this->body;
        }

        return $this->bizContent;
    }
}
