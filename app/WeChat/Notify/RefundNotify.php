<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/5/24
 * Time: 4:41 下午
 */

namespace App\WeChat\Notify;


class RefundNotify extends Notify
{
    /**
     * 返回字段:["return_code","return_msg","appid","mch_id","nonce_str","sign","result_code","transaction_id","out_trade_no",
     * "out_refund_no","refund_id","refund_channel","refund_fee","coupon_refund_fee","total_fee","cash_fee",
     * "coupon_refund_count","cash_refund_fee","err_code","err_code_des"]
     */

    /**
     * @return mixed
     */
    public function subMchId()
    {
        return $this->get('sub_mch_id');
    }

    /**
     * @return mixed
     */
    public function transactionId()
    {
        return $this->get('transaction_id');
    }

    /**
     * @return mixed
     */
    public function outTradeNo()
    {
        return $this->get('out_trade_no');
    }

    /**
     * @return mixed
     */
    public function outRefundNo()
    {
        return $this->get('out_refund_no');
    }

    /**
     * @return mixed
     */
    public function refundId()
    {
        return $this->get('refund_id');
    }

    /**
     * @return mixed
     */
    public function refundChannel()
    {
        return $this->get('refund_channel');
    }

    /**
     * @return mixed
     */
    public function refundFee()
    {
        return $this->get('refund_fee');
    }

    /**
     * @return mixed
     */
    public function couponRefundFee()
    {
        return $this->get('coupon_refund_fee');
    }

    /**
     * @return mixed
     */
    public function totalFee()
    {
        return $this->get('total_fee');
    }

    /**
     * @return mixed
     */
    public function cashFee()
    {
        return $this->get('cash_fee');
    }

    /**
     * @return mixed
     */
    public function couponRefundCount()
    {
        return $this->get('coupon_refund_count');
    }

    /**
     * @return mixed
     */
    public function cashRefundFee()
    {
        return $this->get('cash_refund_fee');
    }
}
