<?php

namespace App\Http\Controllers\Api;


use App\Traits\Wechat\WechatPayManagers;
use Illuminate\Http\Request;

class WechatPayController extends BaseController
{
    use WechatPayManagers;
}
