<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Library\AuthenticatedUser;
use App\WeChat\WechatDefaultConfig;

class BaseController extends ApiController
{
    use WechatDefaultConfig, AuthenticatedUser;

    /**
     * @return array|string|null
     */
    protected function getOpenidForRequest(){
        $openid = $this->request->input('openid');
        if (!empty($openid)) return $openid;
        return $this->request->header('openid');
    }

    /**
     * @return array|string|null
     */
    protected function getAppidForRequest(){
        $appid = $this->request->input('appid');
        if (!empty($appid)) return $appid;
        return $this->request->header('appid');
    }
}
