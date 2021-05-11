<?php

namespace App\Http\Controllers\Home;


use App\Jobs\RefundMoneyJob;
use App\Models\Material;
use App\Models\PrePay;
use App\Models\ProductCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductItem;
use App\Models\Refund;
use App\Models\Transaction;
use App\Notifications\RegisteredNotification;
use App\Traits\Foundation\MenuTrait;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Ramsey\Uuid\Uuid;

class TestController extends Controller
{
    use WechatDefaultConfig, MenuTrait;

    public function index(Request $request)
    {
        return $this->get($request);
    }

    public function video(Request $request)
    {

        return $this->view('home.video');
    }

    public function table()
    {
        return str_replace('"', "'", json_encode(Schema::getColumnListing('post_comment')));
    }
}
