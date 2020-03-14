<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/10/26
 * Time: 11:21 PM
 */

namespace App\WeChat;


use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class WechatSubscribeHandler implements EventHandlerInterface
{
    public function handle($payload = null)
    {
        // TODO: Implement handle() method.
        return $payload;
    }
}
