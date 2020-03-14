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
 * Time: 下午10:27
 */

namespace App\Alipay\Response;


class AlipayTradeQueryResponse
{
    const WAIT_BUYER_PAY = 'WAIT_BUYER_PAY'; //交易创建，等待买家付款
    const TRADE_CLOSED   = 'TRADE_CLOSED'; //未付款交易超时关闭，或支付完成后全额退款
    const TRADE_SUCCESS  = 'TRADE_SUCCESS'; //交易支付成功
    const TRADE_FINISHED = 'TRADE_FINISHED'; //交易结束，不可退款

    private $response = [
        'code'=>'',
        'msg'=>'',
        'sub_code'=>'',
        'sub_msg'=>'',
        'sign'=>'',
        'buyer_logon_id'=>'',
        'buyer_pay_amount'=>'',
        'buyer_user_id'=>'',
        'invoice_amount'=>'',
        'out_trade_no'=>'',
        'point_amount'=>'',
        'receipt_amount'=>'',
        'send_pay_date'=>'',
        'total_amount'=>'',
        'trade_no'=>'',
        'trade_status'=>''
    ];

    /**
     * @param array $data
     * @return $this
     */
    public function data(array $data)
    {
        foreach ($data as $key=>$value) {
            $this->response[$key] = $value;
        }
        return $this;
    }

    public function responses(){
        return $this->response;
    }

    public function code()
    {
        return $this->response['code'];
    }

    public function msg()
    {
        return $this->response['msg'];
    }

    public function subCode()
    {
        return $this->response['sub_code'];
    }

    public function subMsg()
    {
        return $this->response['sub_msg'];
    }

    public function sign()
    {
        return $this->response['sign'];
    }

    public function buyerLogonId()
    {
        return $this->response['buyer_logon_id'];
    }

    public function buyerPayAmount()
    {
        return $this->response['buyer_pay_amount'];
    }

    public function buyerUserId()
    {
        return $this->response['buyer_user_id'];
    }

    public function invoiceAmount()
    {
        return $this->response['invoice_amount'];
    }

    public function outTradeNo()
    {
        return $this->response['out_trade_no'];
    }

    public function pointAmount()
    {
        return $this->response['point_amount'];
    }

    public function receiptAmount()
    {
        return $this->response['receipt_amount'];
    }

    public function sendPayDate()
    {
        return $this->response['send_pay_date'];
    }

    public function totalAmount()
    {
        return $this->response['total_amount'];
    }

    public function tradeNo()
    {
        return $this->response['trade_no'];
    }

    public function tradeStatus()
    {
        return $this->response['trade_status'];
    }

    public function waitBuyerPay()
    {
        return $this->tradeStatus() == self::WAIT_BUYER_PAY;
    }

    public function tradeClosed()
    {
        return $this->tradeStatus() == self::TRADE_CLOSED;
    }

    public function tradeSuccess()
    {
        return $this->tradeStatus() == self::TRADE_SUCCESS;
    }

    public function tradeFinished()
    {
        return $this->tradeStatus() == self::TRADE_FINISHED;
    }
}
