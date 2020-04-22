<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/11/15
 * Time: 3:42 PM
 */

namespace App\Models\Traits;


use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Message\TemplateMessage;

trait WechatMessageAble
{
    use WechatDefaultConfig;

    /**
     * @param TemplateMessage $message
     * @return array|bool|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendWechatTemplateMessage(TemplateMessage $message)
    {
        $appid = $this->officialAccount()->config->get('app_id');
        $connect = $this->connects()->where('appid', $appid)->first();
        if ($connect)
        {
            $message->setTouser($connect->openid);
            return $this->officialAccount()->template_message->send($message->getMsgContent());
        }

        return false;
    }
}
