<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/5/24
 * Time: 10:08 上午
 */

namespace App\Services;


use App\Models\User;
use App\Models\UserConnect;
use App\Services\Contracts\WechatServiceInterface;

class WechatService implements WechatServiceInterface
{

    protected $wechatUserInfo;

    public function __construct($wechatUserInfo = [])
    {
        $this->wechatUserInfo = collect($wechatUserInfo);
    }

    /**
     * @param string $appid
     * @param array $wechatUserInfo
     * @param string $openid
     * @param null $unionid
     * @return User|\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
     */
    public function register($wechatUserInfo)
    {
        // TODO: Implement register() method.
        $this->wechatUserInfo = collect($wechatUserInfo);
        $connect = UserConnect::firstOrNew(['openid' => $this->wechatUserInfo->get('openid')]);
        $connect->fill($wechatUserInfo);
        $connect->platform = 'wechat';

        if (!$user = $connect->user) {
            if ($this->wechatUserInfo->get('unionid')) {
                if ($unionConnect = UserConnect::findByUnionid($this->wechatUserInfo->get('unionid'))) {
                    $user = $unionConnect->user;
                }
            }
        }

        if (!$user) $user = new User();
        //更新用户信息
        $user->username = $this->wechatUserInfo->get('nickname');
        $user->avatar = $this->wechatUserInfo->get('avatar');
        $user->save();

        $connect->user()->associate($user);
        $connect->save();

        $user->profile->fill([
            'gender' => $this->wechatUserInfo->get('gender'),
            'country' => $this->wechatUserInfo->get('country'),
            'province' => $this->wechatUserInfo->get('province'),
            'city' => $this->wechatUserInfo->get('city'),
        ])->save();

        return $user;
    }
}
