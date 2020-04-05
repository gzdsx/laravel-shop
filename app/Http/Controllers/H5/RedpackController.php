<?php

namespace App\Http\Controllers\H5;


use Illuminate\Http\Request;

class RedpackController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        //$this->middleware('wechat.oauth');
    }

    /**
     * @param Request $request
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(Request $request)
    {
        $result = $this->payment()->redpack->sendNormal([
            'mch_billno' => time(),
            'send_name' => '临沧云洲',
            're_openid' => session('wechat_user.openid'),
            'total_num' => 1,  //固定为1，可不传
            'total_amount' => 100,  //单位为分，不小于100
            'wishing' => '祝福语',
            //'client_ip'    => '192.168.0.1',  //可不传，不传则由 SDK 取当前客户端 IP
            'act_name' => '新人大礼包',
            'remark' => '测试备注',
        ]);

        return ajaxReturn(['result' => $result]);
    }
}
