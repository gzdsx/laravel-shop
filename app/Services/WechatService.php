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

    protected $userInfo;

    /**
     * @param array $userInfo
     * @return User|\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
     */
    public function register($userInfo)
    {
        // TODO: Implement register() method.
        $this->userInfo = collect($userInfo);
        $connect = UserConnect::firstOrNew(['openid' => $this->userInfo->get('openid')]);
        $connect->fill($userInfo)->fill(['platform' => 'wechat']);

        if (!$user = $connect->user) {
            if ($unionid = $this->userInfo->get('unionid')) {
                if ($unionConnect = UserConnect::whereHas('user')->where('unionid', $unionid)->first()) {
                    $user = $unionConnect->user;
                } else {
                    $user = new User();
                }
            } else {
                $user = new User();
            }
        }
        //更新用户信息
        $user->username = $this->userInfo->get('nickname');
        $user->avatar = $this->userInfo->get('avatar');
        $user->save();
        //关联用户
        $connect->user()->associate($user);
        $connect->save();
        //更新用户资料
        $user->profile->fill($this->userInfo->all())->save();

        return $user;
    }
}
