<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-03-13
 * Time: 15:47
 */

namespace App\WeChat\Response;


use Illuminate\Support\Collection;

class WechatPayResponse extends Collection
{
    use HasCommonFields;
    /**
     * 返回字段:["appid","bank_type","cash_fee","fee_type","is_subscribe","mch_id","nonce_str",
     * "openid","out_trade_no","result_code","return_code","sign","time_end","total_fee",
     * "trade_type","transaction_id","err_code","err_code_des"]
     */

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
    public function cashFee()
    {
        return $this->get('cash_fee');
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
    public function isSubscribe()
    {
        return $this->get('is_subscribe');
    }

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
    public function outTradeNo()
    {
        return $this->get('out_trade_no');
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
    public function totalFee()
    {
        return $this->get('total_fee');
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
    public function transactionId()
    {
        return $this->get('transaction_id');
    }
}
