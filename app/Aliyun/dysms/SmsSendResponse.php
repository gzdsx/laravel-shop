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
 * Time: 10:14 PM
 */

namespace App\Aliyun\dysms;


class SmsSendResponse
{
    private $response = [
        'Message'=>'',
        'RequestId'=>'',
        'BizId'=>'',
        'Code'=>''
    ];

    function __construct($response)
    {
        if (is_object($response))
        {
            $this->response = get_object_vars($response);
        } else {
            $this->response = $response;
        }
    }

    public function getMessage()
    {
        return $this->response['Message'];
    }

    public function getRequestId()
    {
        return $this->response['RequestId'];
    }

    public function getBizId()
    {
        return $this->response['BizId'];
    }

    public function getCode()
    {
        return $this->response['Code'];
    }

    public function isSuccess()
    {
        return $this->getCode() == 'OK' && $this->getCode() == 'OK';
    }
}
