<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\WechatPrePay;
use App\Support\TradeUtil;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Order\UnifiedOrder;
use App\WeChat\Response\UnifiedOrderResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VipController extends BaseController
{
    use WechatDefaultConfig;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVip()
    {
        return jsonSuccess(['vip' => Auth::user()->vip]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function open(Request $request)
    {
        $unifiedOrder = new UnifiedOrder();
        $unifiedOrder->setBody('开通超级会员');
        $unifiedOrder->setTotalFee(1);
        $unifiedOrder->setOutTradeNo(TradeUtil::createTransactionNo());
        $unifiedOrder->setNotifyUrl('notify/vip/paid');
        $unifiedOrder->setOpenid($request->input('openid'));
        $unifiedOrder->setTradeType('JSAPI');

        $res = new UnifiedOrderResponse($this->payment()->order->unify($unifiedOrder->getBizContent()));
        if ($res->tradeSuccess()) {
            $prepay = WechatPrePay::firstOrNew(['out_trade_no' => $unifiedOrder->getOutTradeNo()]);
            $prepay->uid = Auth::id();
            $prepay->username = Auth::user()->username;
            $prepay->prepay_id = $res->prepayId();
            $prepay->data = $unifiedOrder->all();
            $prepay->save();

            return jsonSuccess(['config' => $this->payment()->jssdk->bridgeConfig($res->prepayId(), false)]);
        }

        return jsonError(500, $res->errCodeDes() ?: $res->retrunMsg(), ['extra' => $res->all()]);
    }
}
