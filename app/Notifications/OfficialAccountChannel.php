<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-07-01
 * Time: 16:16
 */

namespace App\Notifications;


use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Notifications\Notification;

class OfficialAccountChannel
{
    use WechatDefaultConfig;

    /**
     * @param $notifiable
     * @param Notification $notification
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($notifiable, Notification $notification)
    {
        $messages = $notification->toOfficialAccount($notifiable);
        foreach ($messages as $message){
            $this->officialAccount()->template_message->send($message);
        }
    }
}
