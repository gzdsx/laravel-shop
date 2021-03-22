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
 * Time: 上午11:37
 */

namespace App\WeChat\Response;


use Illuminate\Support\Collection;

class RefundQueryResponse extends Collection
{
    use HasCommonFields;
    /**
     * 返回字段:["appid","cash_fee","mch_id","nonce_str","out_refund_no_0","out_trade_no",
     * "refund_account_0","refund_channel_0","refund_count","refund_fee","refund_fee_0","refund_id_0",
     * "refund_recv_accout_0","refund_status_0","refund_success_time_0","result_code","return_code",
     * "return_msg","sign","total_fee","transaction_id","err_code","err_code_des"]
     */

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
    public function outTradeNo()
    {
        return $this->get('out_trade_no');
    }

    /**
     * @return mixed
     */
    public function refundCount()
    {
        return $this->get('refund_count');
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
    public function totalFee()
    {
        return $this->get('total_fee');
    }

    public function transactionId()
    {
        return $this->get('transaction_id');
    }
}
