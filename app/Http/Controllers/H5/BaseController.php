<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use WechatDefaultConfig;

    public function __construct(Request $request)
    {
        $this->middleware(function (Request $request, $next){
            $issetOfficialAccount = $this->officialAccount()->config->get('app_id') && $this->officialAccount()->config->get('secret');
            if ($issetOfficialAccount){
                $this->assign([
                    'jssdk_config' => $this->officialAccount()->jssdk->buildConfig(
                        [
                            'onMenuShareQQ',
                            'onMenuShareWeibo',
                            'scanQRCode',
                            'chooseImage',
                            'uploadImage',
                            'getLocation',
                            'openLocation'
                        ],
                        false, false, false)
                ]);
            }
            $this->assign(compact('issetOfficialAccount'));
            return $next($request);
        });
    }
}
