<?php

namespace App\Http\Controllers\Home;

use App\Alipay\Alipay;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\BlockItem;
use App\Models\Item;
use App\Models\ItemCatlog;
use App\Models\ItemPush;
use App\Models\Order;
use App\Models\PostItem;
use App\Models\ProductImages;
use App\Models\ProductNews;
use App\Models\Shop;
use App\Models\User;
use App\Models\UserConnect;
use App\Models\Wallet;
use App\Validators\PasswordValidator;
use App\WeChat\WechatDefaultConfig;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IndexController extends Controller
{

    use WechatDefaultConfig;
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return Item::all();
    }

    public function app(){

        $platform = '';
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
             $platform = 'ios';
        }else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')){
                $platform = 'weixin';
            }else {
                return redirect()->to('https://cugeng.cn/apk/lastest.apk');
            }
        }else{
            return '<h3 style="text-align: center;">请用手机扫码打开此链接</h3>';
        }

        $this->assign(['platform'=>$platform]);
        return $this->view('home.app');
    }
}
