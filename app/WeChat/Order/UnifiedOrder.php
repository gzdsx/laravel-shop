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
 * Time: 16:11
 */

namespace App\WeChat\Order;


use Illuminate\Support\Collection;

class UnifiedOrder extends Collection
{

    /**
     * 所需字段
     * body
     * out_trade_no
     * total_fee
     * spbill_create_ip' 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
     * notify_url 支付结果通知网址，如果不设置则会使用配置里的默认地址
     * trade_type 请对应换成你的支付方式对应的值类型
     * openid
     */

    /**
     * @param $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->put('body', $body);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->get('body');
    }

    /**
     * @param $out_trade_no
     * @return $this
     */
    public function setOutTradeNo($out_trade_no)
    {
        $this->put('out_trade_no', $out_trade_no);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOutTradeNo()
    {
        return $this->get('out_trade_no');
    }

    /**
     * @param $total_fee
     * @return $this
     */
    public function setTotalFee($total_fee)
    {
        $this->put('total_fee', $total_fee);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalFee()
    {
        return $this->get('total_fee');
    }

    /**
     * @param $spbill_create_ip
     * @return $this
     */
    public function setSpbillCreateIp($spbill_create_ip = null)
    {
        $this->put('spbill_create_ip', $spbill_create_ip ?? $_SERVER['REMOTE_ADDR']);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpbillCreateIp()
    {
        return $this->get('spbill_create_ip');
    }

    /**
     * @param $notify_url
     * @return $this
     */
    public function setNotifyUrl($notify_url)
    {
        $this->put('notify_url', url($notify_url));
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->get('notify_url');
    }

    /**
     * @param $trade_type
     * @return $this
     */
    public function setTradeType($trade_type)
    {
        $this->put('trade_type', $trade_type);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTradeType()
    {
        return $this->get('trade_type');
    }

    /**
     * @param $openid
     * @return $this
     */
    public function setOpenid($openid)
    {
        $this->put('openid', $openid);
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
     * @param $attach
     * @return $this
     */
    public function setAttach($attach)
    {
        $this->put('attach', $attach);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttach()
    {
        return $this->get('attach');
    }

    /**
     * @return array
     */
    public function getBizContent()
    {
        if (!$this->getSpbillCreateIp()) {
            $this->setSpbillCreateIp();
        }

        return $this->all();
    }
}
