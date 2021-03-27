<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/12/20
 * Time: 07:15
 */

namespace App\Traits\Live;


use App\Models\Live;
use App\Models\LiveAdmin;
use App\Models\PrePay;
use App\Support\TradeUtil;
use App\Traits\WeChat\WechatDefaultConfig;
use App\WeChat\Order\UnifiedOrder;
use App\WeChat\Response\UnifiedOrderResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

trait LiveTrait
{
    use WechatDefaultConfig;

    /**
     * @return Live|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Live::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $live = $this->repository()->findOrFail($request->input('id'));
        return jsonSuccess(['live' => $live]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->repository()->with(['channel', 'user']);
        if ($state = $request->input('state')) {
            $query->where('state', $state);
        }
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))
                ->orderByDesc('id')->get([
                    'id', 'uid', 'channel_id', 'stream_id', 'title',
                    'image', 'state', 'views', 'start_at', 'expires_at', 'created_at', 'updated_at'
                ])
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $live = $this->repository()->findOrNew($request->input('id'));
        $live->fill($request->input('live', []))->save();
        return jsonSuccess(['live' => $live]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->get()->map(function (Live $live) {
            $live->delete();
        });

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTicket(Request $request)
    {
        $live = $this->repository()->findOrFail($request->input('id'));
        if ($live->watch_mode == 1) {
            return jsonSuccess(['ticket' => true]);
        }

        if (LiveAdmin::where('uid',Auth::id())->first()){
            return jsonSuccess(['ticket' => true]);
        }

        if ($live->invites()->where('uid', Auth::id())->first()) {
            return jsonSuccess(['ticket' => true]);
        }

        return jsonSuccess(['ticket' => Gate::allows('view', $live)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function buyTicket(Request $request)
    {

        $live = $this->repository()->findOrFail($request->input('id'));
        $buyLog = $live->buyLogs()->firstOrCreate(['uid' => Auth::id()]);
        if ($buyLog->pay_state) {
            return jsonError(300, trans('live.you have bought tickets'));
        }

        $appid = $request->input('appid', 1);
        $openid = $request->input('openid', session('wechat_oauth_user.openid'));
        $payment = $this->payment($appid);
        $unifiedOrder = new UnifiedOrder();
        $unifiedOrder->setBody(trans('live.live ticket') . '-' . $live->title)
            ->setOutTradeNo(TradeUtil::createTransactionNo())
            ->setTotalFee($live->price * 100)
            ->setAttach($buyLog->id)
            ->setOpenid($openid)
            ->setTradeType($payment->config->get('trade_type'))
            ->setNotifyUrl('/notify/live/paid/' . $appid);
        $res = new UnifiedOrderResponse($payment->order->unify($unifiedOrder->getBizContent()));
        if ($res->tradeSuccess()) {
            $prepay = new PrePay();
            $prepay->uid = Auth::id();
            $prepay->username = Auth::user()->username;
            $prepay->prepay_id = $res->prepayId();
            $prepay->out_trade_no = $unifiedOrder->getOutTradeNo();
            $prepay->data = $unifiedOrder->all();
            $prepay->save();

            return jsonSuccess(['config' => $payment->jssdk->bridgeConfig($res->prepayId(), false)]);
        } else {
            return jsonError(500, $res->errCodeDes() ?: '', ['extra' => $res->all()]);
        }
    }
}
