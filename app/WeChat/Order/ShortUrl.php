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
 * Time: 下午12:09
 */

namespace App\WeChat\Order;

use Illuminate\Support\Collection;

class ShortUrl extends Collection
{
    use HasNonceStr;
    /**
     * 所需字段
     * long_url,
     * nonce_str
     */

    /**
     * 设置需要转换的URL，签名用原串，传输需URL encode
     * @param string $value
     * @return $this
     **/
    public function setLongUrl($value)
    {
        $this->put('long_url', $value);
        return $this;
    }

    /**
     * 获取需要转换的URL，签名用原串，传输需URL encode的值
     * @return string 值
     **/
    public function getLongUrl()
    {
        return $this->get('long_url');
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
