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
 * Time: 上午11:48
 */

namespace App\WeChat\Order;


use Illuminate\Support\Collection;

class DownloadBillOrder extends Collection
{
    use HasNonceStr;
    /**
     * 所需字段列表
     * device_info,
     * nonce_str,
     * bill_date,
     * bill_type
     */

    /**
     * 设置微信支付分配的终端设备号，填写此字段，只下载该设备号的对账单
     * @param string $value
     * @return $this
     **/
    public function setDeviceInfo($value)
    {
        $this->put('device_info', $value);
        return $this;
    }

    /**
     * 获取微信支付分配的终端设备号，填写此字段，只下载该设备号的对账单的值
     * @return string 值
     **/
    public function getDeviceInfo()
    {
        return $this->get('device_info');
    }

    /**
     * 设置下载对账单的日期，格式：20140603
     * @param string $value
     * @return $this
     **/
    public function setBillDate($value)
    {
        $this->put('bill_date', $value);
        return $this;
    }

    /**
     * 获取下载对账单的日期，格式：20140603的值
     * @return string 值
     **/
    public function getBillDate()
    {
        return $this->get('bill_date');
    }

    /**
     * 设置ALL，返回当日所有订单信息，默认值SUCCESS，返回当日成功支付的订单,REFUND，返回当日退款订单REVOKED，已撤销的订单
     * @param string $value
     * @return $this
     **/
    public function setBillType($value)
    {
        $this->put('bill_type', $value);
        return $this;
    }

    /**
     * 获取ALL，返回当日所有订单信息，默认值SUCCESS，返回当日成功支付的订单REFUND，返回当日退款订单REVOKED，已撤销的订单的值
     * @return string 值
     **/
    public function getBillType()
    {
        return $this->get('bill_type');
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
