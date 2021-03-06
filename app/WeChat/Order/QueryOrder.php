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
 * Time: 上午9:19
 */

namespace App\WeChat\Order;


use Illuminate\Support\Collection;

class QueryOrder extends Collection
{
    use HasNonceStr;

    /**
     * 所需字段
     * transaction_id,
     * out_trade_no,
     * nonce_str
     */

    /**
     * 设置微信的订单号，优先使用
     * @param $transaction_id
     * @return $this
     */
    public function setTransactionId($transaction_id)
    {
        $this->put('transaction_id', $transaction_id);
        return $this;
    }

    /**
     * 获取微信的订单号，优先使用的值
     * @return string 值
     **/
    public function getTransactionId()
    {
        return $this->get('transaction_id');
    }

    /**
     * 设置商户系统内部的订单号，当没提供transaction_id时需要传这个。
     * @param $value
     * @return $this
     */
    public function setOutTradeNo($value)
    {
        $this->put('out_trade_no', $value);
        return $this;
    }

    /**
     * 获取商户系统内部的订单号，当没提供transaction_id时需要传这个。的值
     * @return string 值
     **/
    public function getOutTradeNo()
    {
        return $this->get('out_trade_no');
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
