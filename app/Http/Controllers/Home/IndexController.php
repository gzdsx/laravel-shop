<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->view('home.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|string
     */
    public function app(Request $request)
    {

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
            return redirect()->to('https://apps.apple.com/cn/app/id1544829486?l=zh&ls=1');
        } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Android')) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
                $platform = 'weixin';
                return $this->view('home.app',compact('platform'));
            } else {
                return redirect()->to('https://shop.gzdsx.cn/apk/shopapp.apk');
            }
        } else {
            return '<h3 style="text-align: center;">请用手机扫码打开此链接</h3>';
        }
    }
}
