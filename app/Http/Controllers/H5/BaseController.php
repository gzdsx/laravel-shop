<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use WechatDefaultConfig;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware(function (Request $request, $next) {
            try {
                $jssdk_config = $this->officialAccount()->jssdk->buildConfig(
                    [
                        'onMenuShareQQ',
                        'onMenuShareWeibo',
                        'scanQRCode',
                        'chooseImage',
                        'uploadImage',
                        'getLocation',
                        'openLocation',
                        'updateTimelineShareData',
                        'updateAppMessageShareData'
                    ],
                    false, false, false);
            } catch (\Exception $exception) {
                $jssdk_config = [];
                if (env('APP_DEBUG')) {
                    //dump($exception);
                }
            }

            $this->assign(compact('jssdk_config'));
            return $next($request);
        });
    }
}
