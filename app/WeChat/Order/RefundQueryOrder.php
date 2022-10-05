<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/8/29
 * Time: 上午11:21
 */

namespace App\WeChat\Order;


use Illuminate\Support\Collection;

class RefundQueryOrder extends Collection
{
    use HasNonceStr;

    /**
     * 所需字段
     * device_info
     * nonce_str
     * transaction_id
     * out_trade_no
     * out_refund_no
     * refund_id
     */

    /**
     * 设置微信支付分配的终端设备号
     * @param string $value
     * @return $this
     **/
    public function setDeviceInfo($value)
    {
        $this->put('device_info', $value);
        return $this;
    }

    /**
     * 获取微信支付分配的终端设备号的值
     * @return string 值
     **/
    public function getDeviceInfo()
    {
        return $this->get('device_info');
    }

    /**
     * 设置微信订单号
     * @param string $value
     * @return $this
     **/
    public function setTransactionId($value)
    {
        $this->put('transaction_id', $value);
        return $this;
    }

    /**
     * 获取微信订单号的值
     * @return string 值
     **/
    public function getTransactionId()
    {
        return $this->get('transaction_id');
    }

    /**
     * 设置商户系统内部的订单号
     * @param string $value
     * @return $this
     **/
    public function setOutTradeNo($value)
    {
        $this->put('out_trade_no', $value);
        return $this;
    }

    /**
     * 获取商户系统内部的订单号的值
     * @return string 值
     **/
    public function getOutTradeNo()
    {
        return $this->get('out_trade_no');
    }

    /**
     * 设置商户退款单号
     * @param string $value
     * @return $this
     **/
    public function setOutRefundNo($value)
    {
        $this->put('out_refund_no', $value);
        return $this;
    }

    /**
     * 获取商户退款单号的值
     * @return string 值
     **/
    public function getOutRefundNo()
    {
        return $this->get('out_refund_no');
    }

    /**
     * 设置微信退款单号refund_id、out_refund_no、out_trade_no、transaction_id四个参数必填一个，如果同时存在优先级为：refund_id>out_refund_no>transaction_id>out_trade_no
     * @param string $value
     * @return $this
     **/
    public function setRefundId($value)
    {
        $this->put('refund_id', $value);
        return $this;
    }

    /**
     * 获取微信退款单号refund_id、out_refund_no、out_trade_no、transaction_id四个参数必填一个，如果同时存在优先级为：refund_id>out_refund_no>transaction_id>out_trade_no的值
     * @return string 值
     **/
    public function getRefundId()
    {
        return $this->get('refund_id');
    }

    /**
     * @return array
     */
    public function getBizContent()
    {
        if (!$this->getNonceStr()) {
            $this->setNonceStr();
        }
        return $this->all();
    }
}
