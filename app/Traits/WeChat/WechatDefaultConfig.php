<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/22
 * Time: 2:18 上午
 */

namespace App\Traits\WeChat;

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