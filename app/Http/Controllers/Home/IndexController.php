<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        return $this->view('home.index');
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
