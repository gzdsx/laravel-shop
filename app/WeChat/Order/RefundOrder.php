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
 * Time: 上午10:57
 */

namespace App\WeChat\Order;


use Illuminate\Support\Collection;

class RefundOrder extends Collection
{
    use HasNonceStr;
    /**
     * 所需字段列表
     * device_info,
     * nonce_str,
     * transaction_id,
     * out_trade_no,
     * out_refund_no,
     * total_fee,
     * refund_fee,
     * refund_fee_type,
     * op_user_id,
     * refund_desc
     */

    /**
     * 设置微信支付分配的终端设备号，与下单一致
     * @param string $value
     * @return $this
     **/
    public function setDeviceInfo($value)
    {
        $this->put('device_info', $value);
        return $this;
    }

    /**
     * 获取微信支付分配的终端设备号，与下单一致的值
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
     * 设置商户系统内部的订单号,transaction_id、out_trade_no二选一，如果同时存在优先级：transaction_id> out_trade_no
     * @param string $value
     * @return $this
     **/
    public function setOutTradeNo($value)
    {
        $this->put('out_trade_no', $value);
        return $this;
    }

    /**
     * 获取商户系统内部的订单号,transaction_id、out_trade_no二选一，如果同时存在优先级：transaction_id> out_trade_no的值
     * @return string 值
     **/
    public function getOutTradeNo()
    {
        return $this->get('out_trade_no');
    }

    /**
     * 设置商户系统内部的退款单号，商户系统内部唯一，同一退款单号多次请求只退一笔
     * @param string $value
     * @return $this
     **/
    public function setOutRefundNo($value)
    {
        $this->put('out_refund_no', $value);
        return $this;
    }

    /**
     * 获取商户系统内部的退款单号，商户系统内部唯一，同一退款单号多次请求只退一笔的值
     * @return string 值
     **/
    public function getOutRefundNo()
    {
        return $this->get('out_refund_no');
    }

    /**
     * 设置订单总金额，单位为分，只能为整数，详见支付金额
     * @param string $value
     * @return $this
     **/
    public function setTotalFee($value)
    {
        $this->put('total_fee', $value);
        return $this;
    }

    /**
     * 获取订单总金额，单位为分，只能为整数，详见支付金额的值
     * @return string 值
     **/
    public function getTotalFee()
    {
        return $this->get('total_fee');
    }

    /**
     * 设置退款总金额，订单总金额，单位为分，只能为整数，详见支付金额
     * @param string $value
     * @return $this
     **/
    public function setRefundFee($value)
    {
        $this->put('refund_fee', $value);
        return $this;
    }

    /**
     * 获取退款总金额，订单总金额，单位为分，只能为整数，详见支付金额的值
     * @return string 值
     **/
    public function getRefundFee()
    {
        return $this->get('refund_fee');
    }

    /**
     * 设置货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型
     * @param string $value
     * @return $this
     **/
    public function setRefundFeeType($value)
    {
        $this->put('refund_fee_type', $value);
        return $this;
    }

    /**
     * 获取货币类型，符合ISO 4217标准的三位字母代码，默认人民币：CNY，其他值列表详见货币类型的值
     * @return string 值
     **/
    public function getRefundFeeType()
    {
        return $this->get('refund_fee_type');
    }

    /**
     * 设置操作员帐号, 默认为商户号
     * @param string $value
     * @return $this
     **/
    public function setOpUserId($value)
    {
        $this->put('op_user_id', $value);
        return $this;
    }

    /**
     * 获取操作员帐号, 默认为商户号的值
     * @return string 值
     **/
    public function getOpUserId()
    {
        return $this->get('op_user_id');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setRefundDesc($value)
    {
        $this->put('refund_desc', $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRefundDesc()
    {
        return $this->get('refund_desc');
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
