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
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Ramsey\Uuid\Uuid;

class TestController extends Controller
{
    use WechatDefaultConfig;

    public function index(Request $request)
    {
//        $res = $this->miniProgram()->subscribe_message->send([
//            'template_id' => 'wCTnBipst6b7mAaGN1G2rcSjEnPTmWRyGe_f0lHMtBM',
//            'touser' => 'oE8ow5TFvtUTkSpKKHoUO8tgbDso',
//            'page' => 'pages/index/index',
//            'data' => [
//                'character_string1' => [
//                    'value' => time()
//                ],
//                'amount2' => [
//                    'value' => '100.00'
//                ],
//                'thing3' => [
//                    'value' => 'iPhone12'
//                ],
//                'time4' => [
//                    'value' => date('Y-m-d H:i:s')
//                ]
//            ]
//        ]);
//
//        $res = $this->miniProgram()->subscribe_message->send([
//            'template_id' => 'v5frdVdAObsRbWg2U_V5mHctXrIJmDFR5YJ4zjTUJiA',
//            'touser' => 'oE8ow5TFvtUTkSpKKHoUO8tgbDso',
//            'page' => 'pages/index/index',
//            'data' => [
//                'thing2' => [
//                    'value' => 'iPhone12'
//                ],
//                'name3' => [
//                    'value' => '顺丰快递'
//                ],
//                'character_string4' => [
//                    'value' => time()
//                ]
//            ]
//        ]);
//
//        $res = $this->miniProgram()->customer_service->message('你好')->to('oE8ow5TFvtUTkSpKKHoUO8tgbDso')->send();

//        $res = $this->miniProgram()->uniform_message->send([
//            'touser' => 'oE8ow5TFvtUTkSpKKHoUO8tgbDso',
//            'mp_template_msg' => [
//                'appid' => $this->officialAccount()->config->get('app_id'),
//                'template_id' => 'hYZbMv0kWZYlkPCoHz_TNL495mj0hU3Dzewr_QItqjg',
//                'url' => \url(''),
//                'miniprogram' => [
//                    'appid' => $this->miniProgram()->config->get('app_id'),
//                    'path' => '/pages/index/index'
//                ],
//                'data' => [
//                    'first' => '恭喜你购买成功！',
//                    'delivername' => '顺丰快递',
//                    'ordername' => time(),
//                    'remark' => '期待您下次光临'
//                ]
//            ]
//        ]);
//
//        dd($res);

        return Transaction::find(103)->fill([])->markAsPaid();
    }

    public function video(Request $request)
    {

        return $this->view('home.video');
    }
}
