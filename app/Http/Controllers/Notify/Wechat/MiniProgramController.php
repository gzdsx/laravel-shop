<?php

namespace App\Http\Controllers\Notify\Wechat;

use App\Http\Controllers\Controller;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;

class MiniProgramController extends Controller
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \ReflectionException
     */
    public function server(Request $request)
    {
        $app = $this->miniProgram();
        $app->server->push(function ($message) use ($app) {
            return true;
        });
        return $app->server->serve();
    }
}
