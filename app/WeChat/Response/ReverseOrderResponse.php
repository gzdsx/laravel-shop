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
 * Time: 上午10:34
 */

namespace App\WeChat\Response;


use Illuminate\Support\Collection;

class ReverseOrderResponse extends Collection
{
    use HasCommonFields;

    /**
     * 返回字段:["return_code","return_msg","appid","mch_id","nonce_str","sign","result_code","err_code","err_code_des","recall"]
     */

    public function recall()
    {
        return $this->values['recall'];
    }
}
