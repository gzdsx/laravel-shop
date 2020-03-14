<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/10/25
 * Time: 6:47 PM
 */

namespace App\WeChat;


class WechatOauthUser
{
    protected $userinfo = [
        'openid'=>'',
        'nickname'=>'',
        'sex'=>'',
        'province'=>'',
        'city'=>'',
        'country'=>'',
        'headimgurl'=>'',
        'privilege'=>'',
        'unionid'=>''
    ];

    public function __construct($data = [])
    {
        if (!empty($data)) {
            foreach ($data as $key=>$value){
                $this->userinfo[$key] = $value;
            }
        }
    }

    public function openid()
    {
        return $this->userinfo['openid'];
    }

    public function nickname()
    {
        return $this->userinfo['nickname'];
    }

    public function sex()
    {
        return $this->userinfo['sex'];
    }

    public function province()
    {
        return $this->userinfo['province'];
    }

    public function city()
    {
        return $this->userinfo['city'];
    }

    public function country()
    {
        return $this->userinfo['country'];
    }

    public function headimgurl()
    {
        return $this->userinfo['headimgurl'];
    }

    public function privilege()
    {
        return $this->userinfo['privilege'];
    }

    public function unionid()
    {
        return $this->userinfo['unionid'];
    }

    public function userinfo()
    {
        return $this->userinfo;
    }
}
