<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/10/26
 * Time: 10:30 AM
 */

namespace App\WeChat\Response;


use Illuminate\Support\Collection;

class QueryOrderResponse extends Collection
{
    use HasCommonFields;

    /**
     * 返回字段:["return_code","return_msg","appid","mch_id","nonce_str","sign","result_code","openid",
     * "is_subscribe","trade_type","bank_type","total_fee","fee_type","transaction_id","out_trade_no",
     * "attach","time_end","trade_state","cash_fee","trade_state_desc","err_code","err_code_des"]
     */

    /**
     * @return mixed
     */
    public function openid()
    {
        return $this->get('openid');
    }

    /**
     * @return mixed
     */
    public function isSubscribe()
    {
        return $this->get('is_subscribe');
    }

    /**
     * @return mixed
     */
    public function tradeType()
    {
        return $this->get('trade_type');
    }

    /**
     * @return mixed
     */
    public function bankType()
    {
        return $this->get('bank_type');
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
    public function feeType()
    {
        return $this->get('fee_type');
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
    public function attach()
    {
        return $this->get('attach');
    }

    /**
     * @return mixed
     */
    public function timeEnd()
    {
        return $this->get('time_end');
    }

    /**
     * @return mixed
     */
    public function tradeState()
    {
        return $this->get('trade_state');
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
    public function tradeStateDesc()
    {
        return $this->get('trade_state_desc');
    }
}
