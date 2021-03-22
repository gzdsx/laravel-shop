<?php

namespace App\Http\Controllers\Home;


use App\Jobs\RefundMoneyJob;
use App\Models\PrePay;
use App\Models\ProductCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Refund;
use App\Notifications\RegisteredNotification;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    use WechatDefaultConfig;

    public function index(Request $request)
    {
        return Auth::user()->token();
    }

    public function video(Request $request)
    {

        return $this->view('home.video');
    }
}
