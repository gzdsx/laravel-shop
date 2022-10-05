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
 * Time: 下午12:02
 */

namespace App\WeChat\Order;


use Illuminate\Support\Collection;

class ReportOrder extends Collection
{
    use HasNonceStr;
    /**
     * 所需字段列表
     * device_info,
     * nonce_str,
     * interface_url,
     * execute_time_,
     * return_code
     */

    /**
     * 设置微信支付分配的终端设备号，商户自定义
     * @param string $value
     * @return $this
     **/
    public function setDeviceInfo($value)
    {
        $this->put('device_info', $value);
        return $this;
    }

    /**
     * 获取微信支付分配的终端设备号，商户自定义的值
     * @return string 值
     **/
    public function getDeviceInfo()
    {
        return $this->get('device_info');
    }

    /**
     * 设置上报对应的接口的完整URL，类似：https://api.mch.weixin.qq.com/pay/unifiedorder对于被扫支付，为更好的和商户共同分析一次业务行为的整体耗时情况，对于两种接入模式，请都在门店侧对一次被扫行为进行一次单独的整体上报，上报URL指定为：https://api.mch.weixin.qq.com/pay/micropay/total关于两种接入模式具体可参考本文档章节：被扫支付商户接入模式其它接口调用仍然按照调用一次，上报一次来进行。
     * @param string $value
     * @return $this
     **/
    public function setInterfaceUrl($value)
    {
        $this->put('interface_url', $value);
        return $this;
    }

    /**
     * 获取上报对应的接口的完整URL，类似：https://api.mch.weixin.qq.com/pay/unifiedorder对于被扫支付，为更好的和商户共同分析一次业务行为的整体耗时情况，对于两种接入模式，请都在门店侧对一次被扫行为进行一次单独的整体上报，上报URL指定为：https://api.mch.weixin.qq.com/pay/micropay/total关于两种接入模式具体可参考本文档章节：被扫支付商户接入模式其它接口调用仍然按照调用一次，上报一次来进行。的值
     * @return string 值
     **/
    public function getInterfaceUrl()
    {
        return $this->get('interface_url');
    }

    /**
     * 设置接口耗时情况，单位为毫秒
     * @param string $value
     * @return $this
     **/
    public function setExecuteTime_($value)
    {
        $this->put('execute_time_', $value);
        return $this;
    }

    /**
     * 获取接口耗时情况，单位为毫秒的值
     * @return string 值
     **/
    public function getExecuteTime_()
    {
        return $this->get('execute_time_');
    }

    /**
     * 设置SUCCESS/FAIL此字段是通信标识，非交易标识，交易是否成功需要查看trade_state来判断
     * @param string $value
     * @return $this
     **/
    public function setReturnCode($value)
    {
        $this->put('return_code', $value);
        return $this;
    }

    /**
     * 获取SUCCESS/FAIL此字段是通信标识，非交易标识，交易是否成功需要查看trade_state来判断的值
     * @return string 值
     **/
    public function getReturnCode()
    {
        return $this->get('return_code');
    }

    /**
     * 设置返回信息，如非空，为错误原因签名失败参数格式校验错误
     * @param string $value
     * @return $this
     **/
    public function setReturnMsg($value)
    {
        $this->put('return_msg', $value);
        return $this;
    }

    /**
     * 获取返回信息，如非空，为错误原因签名失败参数格式校验错误的值
     * @return string 值
     **/
    public function getReturnMsg()
    {
        return $this->get('return_msg');
    }

    /**
     * 设置SUCCESS/FAIL
     * @param string $value
     * @return $this
     **/
    public function setResultCode($value)
    {
        $this->put('result_code', $value);
        return $this;
    }

    /**
     * 获取SUCCESS/FAIL的值
     * @return string 值
     **/
    public function getResultCode()
    {
        return $this->get('result_code');
    }

    /**
     * 设置ORDERNOTEXIST—订单不存在SYSTEMERROR—系统错误
     * @param string $value
     * @return $this
     **/
    public function setErrCode($value)
    {
        $this->put('err_code', $value);
        return $this;
    }

    /**
     * 获取ORDERNOTEXIST—订单不存在SYSTEMERROR—系统错误的值
     * @return string 值
     **/
    public function getErrCode()
    {
        return $this->get('err_code');
    }

    /**
     * 设置结果信息描述
     * @param string $value
     * @return $this
     **/
    public function setErrCodeDes($value)
    {
        $this->put('err_code_des', $value);
        return $this;
    }

    /**
     * 获取结果信息描述的值
     * @return string 值
     **/
    public function getErrCodeDes()
    {
        return $this->get('err_code_des');
    }

    /**
     * 设置商户系统内部的订单号,商户可以在上报时提供相关商户订单号方便微信支付更好的提高服务质量。
     * @param string $value
     * @return $this
     **/
    public function setOutTradeNo($value)
    {
        $this->put('out_trade_no', $value);
        return $this;
    }

    /**
     * 获取商户系统内部的订单号,商户可以在上报时提供相关商户订单号方便微信支付更好的提高服务质量。 的值
     * @return string 值
     **/
    public function getOutTradeNo()
    {
        return $this->get('out_trade_no');
    }

    /**
     * 设置发起接口调用时的机器IP
     * @param string $value
     * @return $this
     **/
    public function setUserIp($value)
    {
        $this->put('user_ip', $value);
        return $this;
    }

    /**
     * 获取发起接口调用时的机器IP 的值
     * @return string 值
     **/
    public function getUserIp()
    {
        return $this->get('user_ip');
    }

    /**
     * 设置系统时间，格式为yyyyMMddHHmmss，如2009年12月27日9点10分10秒表示为20091227091010。其他详见时间规则
     * @param string $value
     * @return $this
     **/
    public function setTime($value)
    {
        $this->put('time', $value);
        return $this;
    }

    /**
     * 获取系统时间，格式为yyyyMMddHHmmss，如2009年12月27日9点10分10秒表示为20091227091010。其他详见时间规则的值
     * @return string 值
     **/
    public function getTime()
    {
        return $this->get('time');
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
