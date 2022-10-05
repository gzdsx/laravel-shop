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

class RechargeController extends BaseController
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function unify(Request $request)
    {
        $amount = $request->input('amount');
        if (!$amount) {
            abort(500, 'missing amount value');
        }

        $openid = $request->input('openid');
        if (!$openid) {
            abort(500, 'missing openid value');
        }

        $out_trade_no = TradeUtil::createTransactionNo();
        $unifiedOrder = new UnifiedOrder();
        $unifiedOrder->setBody('充值');
        $unifiedOrder->setTradeType('JSAPI');
        $unifiedOrder->setNotifyUrl('/notify/wechat/recharge');
        $unifiedOrder->setOutTradeNo($out_trade_no);
        $unifiedOrder->setOpenid($openid);
        $unifiedOrder->setTotalFee($amount * 100);

        $payment = $this->payment();
        $res = new UnifiedOrderResponse($payment->order->unify($unifiedOrder->getBizContent()));
        if ($res->tradeSuccess()) {
            $prePay = new WechatPrePay();
            $prePay->out_trade_no = $out_trade_no;
            $prePay->uid = Auth::id();
            $prePay->prepay_id = $res->prepayId();
            $prePay->data = $unifiedOrder->all();
            $prePay->save();

            return jsonSuccess(['config' => $payment->jssdk->bridgeConfig($res->prepayId(), false)]);
        }

        return jsonError(500, $res->errCodeDes() ?: $res->retrunMsg());
    }
}
