<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-22
 * Time: 23:49
 */

namespace App\Services\Wechat;


use App\Repositories\Contracts\UserConnectRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\WechatServiceInterface;
use App\Traits\WeChat\SyncWechatHeadImg;
use Illuminate\Support\Collection;

class WechatAppService implements WechatServiceInterface
{
    use SyncWechatHeadImg;

    protected $userRepository;
    protected $connectRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->connectRepository = app(UserConnectRepositoryInterface::class);
    }


    public function register(array $userInfo)
    {
        // TODO: Implement register() method.
        $wechatUserInfo = new Collection($userInfo);
        $unionid = $wechatUserInfo->get('unionid');
        if (!$openid = $wechatUserInfo->get('openid')) {
            abort(400, 'openid empty');
        }

        if (!$wechatUserInfo->get('appid')) {
            abort(400, 'appid empty');
        }

        $user = null;
        $connect = $this->connectRepository->where('openid', $openid)->first();
        if ($connect) {
            $user = $connect->user;
        } else {
            if ($unionid) {
                $connect = $this->connectRepository->where('unionid', $unionid)->first();
                if ($connect) {
                    $user = $connect->user;
                }
            }
        }
        if (!$user) {
            $user = $this->userRepository->create(['username' => $wechatUserInfo->get('nickName')]);
        }

        $user->connects()->updateOrCreate([
            'openid' => $openid
        ], [
            'unionid' => $unionid,
            'nickname' => $wechatUserInfo->get('nickname'),
            'avatar' => $wechatUserInfo->get('headimgurl'),
            'gender' => $wechatUserInfo->get('sex'),
            'country' => $wechatUserInfo->get('country'),
            'province' => $wechatUserInfo->get('province'),
            'city' => $wechatUserInfo->get('city'),
            'appid' => $wechatUserInfo->get('appid'),
        ]);

        $user->info()->update([
            'gender' => $wechatUserInfo->get('sex'),
            'country' => $wechatUserInfo->get('country'),
            'province' => $wechatUserInfo->get('province'),
            'city' => $wechatUserInfo->get('city'),
        ]);

        //同步头像
        $this->downloadWechatHeadImg($user->uid, $wechatUserInfo->get('headimgurl'));
        return $user;
    }
}