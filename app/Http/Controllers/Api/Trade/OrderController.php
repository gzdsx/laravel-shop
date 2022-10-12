<?php

namespace App\Http\Controllers\Api\Trade;

use Alipay\Factory as AliPay;
use App\Events\Order\OrderPaid;
use App\Http\Controllers\Api\BaseController;
use App\Models\Order;
use App\Models\UserPrepay;
use App\Support\TradeUtil;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Order\UnifiedOrder;
use App\WeChat\Response\UnifiedOrderResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrderController extends BaseController
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pay(Request $request)
    {
        $order = Order::findOrFail($request->input('order_id'));
        if ($order->pay_state) {
            abort(500, trans('trade.order paid'));
        }

        $type = $request->input('type', 'balance');
        if ($type == 'balance') {
            return $this->balancePay($order, $request->input('password'));
        }

        if ($type == 'wechatpay') {
            return $this->wechatPay($order, $request->input('openid'));
        }

        if ($type == 'alipay') {
            return $this->aliPay($order);
        }

        return jsonError(500, 'pay faild');
    }

    /**
     * @param Order $order
     * @return mixed
     * @throws \Throwable
     */
    protected function balancePay(Order $order, $password)
    {
        $account = Auth::user()->account()->firstOrCreate();

        if (!$account->password) {
            abort(530, '您尚未设置支付密码');
        }

        if (!Hash::check($password, $account->password)) {
            abort(500, trans('user.password incorrect'));
        }

        $transaction = $order->transaction;
        if ($transaction->amount > $account->balance) {
            abort(500, trans('account.insufficient account balance'));
        }

        return DB::transaction(function () use ($order, $account, $transaction) {

            $account->balance -= $transaction->amount;
            $account->save();

            $transaction->pay_type = 'balance';
            $transaction->markAsPaid();

            $order->markAsPaid();

            event(new OrderPaid($order));

            return jsonSuccess();
        });
    }

    /**
     * @param Order $order
     * @param $openid
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function wechatPay(Order $order, $openid)
    {

        $payment = $this->payment();
        if (!$openid) {
            abort(500, 'missing openid value');
        }

        $transaction = $order->transaction;
        $unifiedOrder = new UnifiedOrder();
        $unifiedOrder->setBody($transaction->detail)
            ->setOutTradeNo($transaction->out_trade_no)
            ->setTotalFee($transaction->amount * 100)
            ->setOpenid($openid)
            ->setTradeType($payment->config->get('trade_type', 'JSAPI'))
            ->setNotifyUrl('/notify/wechat/order.paid');
        //return jsonSuccess($unifiedOrder->all());
        $res = new UnifiedOrderResponse($payment->order->unify($unifiedOrder->getBizContent()));
        //解决订单号重复问题
        if ($res->errCode() === 'INVALID_REQUEST') {
            $transaction->out_trade_no = TradeUtil::createTransactionNo();
            $transaction->save();

            $unifiedOrder->setOutTradeNo($transaction->out_trade_no);
            $res = new UnifiedOrderResponse($payment->order->unify($unifiedOrder->getBizContent()));
        }

        if ($res->tradeSuccess()) {
            $prepay = UserPrepay::firstOrNew(['out_trade_no' => $unifiedOrder->getOutTradeNo()]);
            $prepay->uid = Auth::id();
            $prepay->payable_id = $order->order_id;
            $prepay->prepay_id = $res->prepayId();
            $prepay->data = $unifiedOrder->all();
            $prepay->save();

            $config = $payment->jssdk->bridgeConfig($res->prepayId(), false);
            return jsonSuccess($config);
        } else {
            return jsonError(500, $res->errCodeDes() ?: $res->retrunMsg(), $res->all());
        }
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function aliPay(Order $order)
    {
        if ($order->isPaid()) {
            return jsonError(600, '订单已支付');
        }

        $detail = $order->items()->first()->title;
        $params = AliPay::appPay(config('alipay.default'))->sendRequest([
            'subject' => $detail,
            'out_trade_no' => $order->order_no,
            'total_amount' => $order->order_fee,
        ]);

        //return jsonSuccess($params);
        return jsonSuccess(['payStr' => http_build_query($params)]);
    }
}
