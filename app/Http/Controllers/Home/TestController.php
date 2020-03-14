<?php

namespace App\Http\Controllers\Home;

use App\Jobs\SendEmail;
use App\Models\Item;
use App\Models\Order;
use App\Models\PostItem;
use App\Models\User;
use App\Notifications\OrderStateNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index(Request $request)
    {
//        $redpackData = [
//            'mch_billno'   => createTransactionNo(),
//            'send_name'    => '红包来啦!',
//            're_openid'    => 'oj0Got63sWfQiSzCuRhHgrvkgpXY',
//            'total_num'    => 1,  //固定为1，可不传
//            'total_amount' => 100,  //单位为分，不小于100
//            'wishing'      => '感谢您参加粗耕购物节活动',
//            'client_ip'    => request()->getClientIp(),  //可不传，不传则由 SDK 取当前客户端 IP
//            'act_name'     => '一起拼团赢红包',
//            'remark'       => '邀请好友来粗耕购物获得红包',
//            // ...
//        ];
//        return $this->payment()->redpack->sendNormal($redpackData);
        //SendEmail::dispatch()->delay(now()->addMinutes(3));
        //SendEmail::dispatch()->delay(now()->addMinutes(3));
        //SendEmail::dispatch()->delay(now()->addMinutes(3));

        User::find('1042159')->notify(new OrderStateNotification(Order::first()));
    }
}
