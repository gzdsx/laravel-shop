<?php

namespace App\Http\Controllers\Auction;

use App\Alipay\Alipay;
use App\Events\OrderEvent;
use App\Exceptions\UserRequestException;
use App\Models\Trade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    public function index(Request $request)
    {
        $step = 'payOrder';
        $order_id = $request->input('order_id', 0);
        $order = $this->user()->boughts()->find($order_id);
        $wallet = $this->user()->wallet()->firstOrCreate([]);
        $transaction = $order->transaction;

        return $this->view('auction.pay', compact('order_id', 'order', 'wallet', 'transaction', 'step'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     * @throws UserRequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function alipay()
    {
        $order_id = $this->request->input('order_id', 0);
        $order_no = $this->request->input('order_no', '');

        if ($order_id) {
            $order = $this->user()->boughts()->find($order_id);
        } else {
            $order = $this->user()->boughts()->where('order_no', $order_no)->first();
        }

        //已支付订单直接跳转
        if ($order->pay_state == 1) {
            return redirect('user/trade/detail?order_id=' . $order_id);
        }

        $transaction = $order->transaction;
        if ($transaction) {
            return Alipay::pay([
                'return_url' => url('auction/pay/alipay_query')
            ])->webPay([
                'out_trade_no' => $transaction->out_trade_no,
                'total_amount' => $transaction->amount,
                //'total_amount'=>0.01,
                'subject' => $transaction->subject,
            ]);
        } else {
            throw new UserRequestException(trans('transaction.transaction records do not exist'), 404);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws UserRequestException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function alipayQuery()
    {
        $out_trade_no = $this->request->input('out_trade_no');
        $query = Alipay::pay()->query(compact('out_trade_no'));

        if ($query->tradeSuccess()) {
            $trade = Trade::where('out_trade_no', $out_trade_no)->first();
            $order = $trade->order;
            if ($trade) {
                if (!$trade->pay_state) {
                    $trade->pay_state = 1;
                    $trade->pay_at = time();
                    $trade->pay_type = 'alipay';
                    $trade->trade_state = 2;
                    $trade->save();

                    if ($order) {
                        $order->pay_state = 1;
                        $order->pay_at = time();
                        $order->trade_state = 2;
                        $order->save();

                        event(new OrderEvent($order, 'paid'));
                    }
                }
            }
            return redirect('auction/pay/success?order_id=' . $order->order_id);
        } else {
            throw new UserRequestException($query->subMsg(), 1);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success()
    {

        $step = 'paySuccess';
        $order_id = $this->request->input('order_id');
        $order = $this->user()->boughts()->find($order_id);
        $this->assign(compact('order_id', 'order', 'step'));

        return $this->view('auction.success');
    }
}
