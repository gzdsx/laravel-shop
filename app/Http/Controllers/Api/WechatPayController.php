<?php

namespace App\Http\Controllers\Api;


use App\Traits\WeChat\WechatPayManagers;
use Illuminate\Http\Request;

class WechatPayController extends BaseController
{
    use WechatPayManagers;
}
