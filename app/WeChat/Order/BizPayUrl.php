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
 * Time: 上午11:55
 */

namespace App\WeChat\Order;


use Illuminate\Support\Collection;

class BizPayUrl extends Collection
{
    use HasNonceStr;

    /**
     * 所需字段
     * time_stamp
     * nonce_str
     * product_id
     */

    /**
     * 设置支付时间戳
     * @param string $value
     * @return $this
     **/
    public function setTimetamp($value = null)
    {
        $this->put('time_stamp', $value ?? time());
        return $this;
    }

    /**
     * 获取支付时间戳的值
     * @return string 值
     **/
    public function getTimestamp()
    {
        return $this->get('time_stamp');
    }

    /**
     * 设置商品ID
     * @param string $value
     * @return $this
     **/
    public function setProductId($value)
    {
        $this->put('product_id', $value);
        return $this;
    }

    /**
     * 获取商品ID的值
     * @return  string 值
     **/
    public function getProductId()
    {
        return $this->get('product_id');
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
