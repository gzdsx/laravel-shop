<?php

namespace App\Http\Controllers\Api\Payment;


use App\Http\Controllers\Api\BaseController;
use App\Traits\WeChat\WechatPayManagers;
use Illuminate\Http\Request;

class WechatPayController extends BaseController
{
    use WechatPayManagers;
}
