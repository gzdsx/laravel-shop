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
 * Time: 下午12:05
 */

namespace App\WeChat\Order;

use Illuminate\Support\Collection;

//企业向个人付款
class TransferOrder extends Collection
{
    use HasNonceStr;

    /**
     * 所需字段
     * mch_appid,
     * mchid,
     * nonce_str,
     * spbill_create_ip,
     * partner_trade_no,
     * check_name,
     * amount,desc,
     * openid,
     * re_user_name
     */

    /**
     * @param $value
     * @return $this
     */
    public function setMchAppid($value)
    {
        $this->put('mch_appid', $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMchAppid()
    {
        return $this->get('mch_appid');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMchid($value)
    {
        $this->put('mchid', $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMchid()
    {
        return $this->get('mchid');
    }

    /**
     * 设置调用微信支付API的机器IP
     * @param string $value
     * @return $this
     **/
    public function setSpbillCreateIp($value = null)
    {
        $this->put('spbill_create_ip', $value ?? $_SERVER['REMOTE_ADDR']);
        return $this;
    }

    /**
     * 获取调用微信支付API的机器IP 的值
     * @return string 值
     **/
    public function getSpbillCreateIp()
    {
        return $this->get('spbill_create_ip');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setPartnerTradeNo($value)
    {
        $this->put('partner_trade_no', $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPartnerTradeNo()
    {
        return $this->get('partner_trade_no');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCheckName($value = 'NO_CHECK')
    {
        $this->put('check_name', $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCheckName()
    {
        return $this->get('check_name');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setAmount($value)
    {
        $this->put('amount', $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->get('amount');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setDesc($value)
    {
        $this->put('desc', $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->get('desc');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setOpenid($value)
    {
        $this->put('openid', $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOpenid()
    {
        return $this->get('openid');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setReUserName($value)
    {
        $this->put('re_user_name', $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReUserName()
    {
        return $this->get('re_user_name');
    }

    /**
     * @return array
     */
    public function getBizContent()
    {
        if (!$this->getNonceStr()) {
            $this->setNonceStr();
        }

        if (!$this->getCheckName()) {
            $this->setCheckName();
        }

        if (!$this->getSpbillCreateIp()) {
            $this->setSpbillCreateIp();
        }
        return $this->all();
    }
}
