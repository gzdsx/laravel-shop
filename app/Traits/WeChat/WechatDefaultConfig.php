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
     * @param string $account
     * @return \EasyWeChat\OfficialAccount\Application
     */
    protected function officialAccount($account = 'default')
    {
        $account = config('wechat.official_account.' . $account) ? $account : 'default';
        return EasyWeChat::officialAccount($account);
    }

    /**
     * @param string $account
     * @return \EasyWeChat\MiniProgram\Application
     */
    protected function miniProgram($account = 'default')
    {
        $account = config('wechat.mini_program.' . $account) ? $account : 'default';
        return EasyWeChat::miniProgram($account);
    }

    /**
     * @param string $account
     * @return \EasyWeChat\Payment\Application
     */
    protected function payment($account = 'default')
    {
        $account = config('wechat.payment.' . $account) ? $account : 'default';
        return EasyWeChat::payment($account);
    }
}
