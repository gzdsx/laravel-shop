<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-05
 * Time: 22:36
 */

namespace App\WeChat\Order;


trait HasNonceStr
{
    /**
     * 设置随机字符串，不长于32位。推荐随机数生成算法
     * @param string $value
     * @return $this
     */
    public function setNonceStr($value = null)
    {
        $this->put('nonce_str', $value ?? strtoupper(md5(time() . rand(100, 999))));
        return $this;
    }

    /**
     * 获取随机字符串，不长于32位。推荐随机数生成算法的值
     * @return string 值
     **/
    public function getNonceStr()
    {
        return $this->get('nonce_str');
    }
}
