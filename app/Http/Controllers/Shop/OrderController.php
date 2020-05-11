<?php

namespace App\Http\Controllers\Shop;

use Alipay\Builder\AlipayPagePayContentBuilder;
use Alipay\Factory;
use App\Http\Controllers\Controller;
use App\Jobs\OrderProcessNotice;
use App\Models\Cart;
use App\Models\Item;
use App\Models\ItemSku;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{

    public function buynow(Request $request)
    {
        $step = 'confirm';
        $item = Item::findOrFail($request->input('itemid'));
        $sku_id = $request->input('sku_id');
        if ($sku_id) {
            $sku = ItemSku::findOrFail($sku_id);
        } else {
            $sku = [
                'stock' => $item->stock,
                'price' => $item->price,
                'title' => '',
                'sku_id' => 0,
            ];
        }
        $item->load(['skus']);
        $addresses = Auth::user()->addresses()->get();
        $quantity = $request->input('quantity', 1);
        $pay_type = $request->input('pay_type', 1);
        $shipping_type = $request->input('shippin_type', 1);

        return $this->view('shop.order.buynow',
            compact('item', 'sku', 'addresses', 'quantity', 'pay_type', 'shipping_type', 'step'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(Request $request)
    {
        $step = 'confirm';
        $items = Cart::where('uid', Auth::id())->whereIn('itemid', $request->input('items', []))->get();
        $addresses = Auth::user()->addresses()->get();
        return $this->view('shop.order.confirm', compact('items', 'addresses','step'));
    }

    public function pay(Request $request)
    {
        $step = 'pay';
        $order = Auth::user()->boughts()->findOrFail($request->input('order_id'));
        $order->load(['items', 'transaction']);

        return $this->view('shop.order.pay', compact('step', 'order'));
    }

    public function payResult(Request $request)
    {
        $step = 'success';
        $order = Auth::user()->boughts()->findOrFail($request->input('order_id'));

        return $this->view('shop.order.result', compact('step', 'order'));
    }

    public function alipay(Request $request)
    {
        $order = Auth::user()->boughts()->findOrFail($request->input('order_id'));
        $transaction = $order->transaction;

        $builder = new AlipayPagePayContentBuilder();
        $builder->setSubject($transaction->subject);
        $builder->setBody($transaction->body);
        $builder->setOutTradeNo($transaction->out_trade_no);
        $builder->setTotalAmount($transaction->amount);
        //$builder->setTotalAmount(0.01);

        return Factory::pagePay()
            ->setReturnUrl(url('order/query/alipay'))
            ->sendRequest($builder->getBizContent());
    }

    public function alipayQuery(Request $request)
    {

        $out_trade_no = $request->input('out_trade_no');
        $res = Factory::query()->sendRequest(['out_trade_no' => $out_trade_no]);
        if ($res['trade_status'] == 'TRADE_SUCCESS') {
            $transaction = Transaction::findByOutTradeNo($out_trade_no);
            if (!$transaction->pay_state){
                $transaction->extra = $request->all();
                $transaction->transaction_state = 2;
                $transaction->pay_state = 1;
                $transaction->pay_at = now();
                $transaction->pay_type = 'alipay';
                $transaction->save();
            }

            if ($transaction->order) {
                if ($transaction->order->pay_state){
                    $transaction->order->order_state = 2;
                    $transaction->order->pay_state = 1;
                    $transaction->order->pay_at = now();
                    $transaction->order->save();

                    dispatch(new OrderProcessNotice($transaction->order, 'paid'));
                }
                return redirect('order/pay/result?order_id=' . $transaction->order->order_id);
            } else {
                return $transaction;
            }
        } else {
            return $res;
        }
    }
}
