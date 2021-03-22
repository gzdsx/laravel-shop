<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/10/25
 * Time: 11:38 PM
 */

namespace App\WeChat\Response;


use Illuminate\Support\Collection;

class UnifiedOrderResponse extends Collection
{

    use HasCommonFields;

    /**
     * 返回字段:[return_code,return_msg,appid,mch_id,nonce_str,sign,result_code,prepay_id,trade_type,err_code,err_code_des]
     */

    /**
     * @return mixed
     */
    public function prepayId()
    {
        return $this->get('prepay_id');
    }

    /**
     * @return mixed
     */
    public function tradeType()
    {
        return $this->get('trade_type');
    }
}
