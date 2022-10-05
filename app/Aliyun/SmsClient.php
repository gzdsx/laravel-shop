<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/1/30
 * Time: 13:43
 */

namespace App\Aliyun;


use AlibabaCloud\Client\AlibabaCloud;

class SmsClient
{
    public $accessKeyId = 'LTAI4G5BMQoogLhbkjf1y4R5';
    public $accessSecret = 'VaGAZ4KE95CWQDO8nxGIjcUyc8n7rq';
    public $SignName = '贵州小猿科技有限公司';
    public $TemplateCode = 'SMS_197185201';
    public $PhoneNumbers;

    public function __construct($accessKeyId = null, $accessSecret = null)
    {
        if ($accessKeyId) $this->accessKeyId = $accessKeyId;
        if ($accessSecret) $this->accessSecret = $accessSecret;
        AlibabaCloud::accessKeyClient($this->accessKeyId, $this->accessSecret)
            ->regionId('cn-hangzhou')
            ->asDefaultClient();
    }

    /**
     * @param null $PhoneNumbers
     * @param array $TemplateParam
     * @param null $SignName
     * @param null $TemplateCode
     * @return \AlibabaCloud\Client\Result\Result
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function send($PhoneNumbers = null, $TemplateParam = [], $SignName = null, $TemplateCode = null)
    {
        if ($PhoneNumbers) $this->PhoneNumbers = $PhoneNumbers;
        if ($SignName) $this->SignName = $SignName;
        if ($TemplateCode) $this->TemplateCode = $TemplateCode;
        if ($TemplateParam) $this->TemplateParam = $TemplateParam;

        return AlibabaCloud::rpc()
            ->product('Dysmsapi')
            // ->scheme('https') // https | http
            ->version('2017-05-25')
            ->action('SendSms')
            ->method('POST')
            ->options([
                'query' => [
                    //需要发送到那个手机
                    'PhoneNumbers' => $this->PhoneNumbers,
                    //必填项 签名(需要在阿里云短信服务后台申请)
                    'SignName' => $this->SignName,
                    //必填项 短信模板code (需要在阿里云短信服务后台申请)
                    'TemplateCode' => $this->TemplateCode,
                    //如果在短信中添加了${code} 变量则此项必填 要求为JSON格式
                    'TemplateParam' => json_encode($this->TemplateParam, 256),
                ],
            ])
            ->request();
    }
}
