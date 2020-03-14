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
 * Time: 10:13 AM
 */

namespace App\WeChat;


use Overtrue\LaravelWeChat\Facade as EasyWeChat;

trait WechatDefaultConfig
{

    /**
     * @param string $name
     * @return \EasyWeChat\OfficialAccount\Application
     */
    protected function officialAccount($name = 'default')
    {
        return EasyWeChat::officialAccount($name);
    }

    /**
     * @param string $name
     * @return \EasyWeChat\MiniProgram\Application
     */
    protected function miniProgram($name = 'default')
    {
        return EasyWeChat::miniProgram($name);
    }

    /**
     * @param string $name
     * @return \EasyWeChat\Payment\Application
     */
    protected function payment($name = 'default')
    {
        return EasyWeChat::payment($name);
    }
}
