<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/10/30
 * Time: 9:42 PM
 */

namespace App\Aliyun\dysms;


class SmsSender
{
    public $security = false;
    public $params = [];

    private $accessKeyId;
    private $accessKeySecret;

    function __construct()
    {
        $this->accessKeyId = config('aliyun.sms.access_key_id');
        $this->accessKeySecret = config('aliyun.sms.access_key_secret');
        $this->setSignName(config('aliyun.sms.sign_name'));
    }

    public function setSecurity($security)
    {
        $this->security = $security;
        return $this;
    }

    public function setPhoneNumbers($phoneNumbers)
    {
        $this->params['PhoneNumbers'] = $phoneNumbers;
        return $this;
    }

    public function setSignName($signName)
    {
        $this->params['SignName'] = $signName;
        return $this;
    }

    public function setTemplateCode($templateCode)
    {
        $this->params['TemplateCode'] = $templateCode;
        return $this;
    }

    public function setTemplateParam($templateParam)
    {
        $this->params['TemplateParam'] = $templateParam;
        return $this;
    }

    public function setOutId($outId)
    {
        $this->params['OutId'] = $outId;
        return $this;
    }

    public function setSmsUpExtendCode($SmsUpExtendCode)
    {
        $this->params['SmsUpExtendCode'] = $SmsUpExtendCode;
    }

    public function send()
    {
        if(!empty($this->params["TemplateParam"]) && is_array($this->params["TemplateParam"])) {
            $this->params["TemplateParam"] = json_encode($this->params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        include __DIR__.'/SignatureHelper.php';
        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new \SignatureHelper();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $this->accessKeyId,
            $this->accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($this->params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            )),
            $this->security
        );

        return new SmsSendResponse($content);
    }
}
