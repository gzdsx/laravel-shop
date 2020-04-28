<?php

namespace App\Http\Controllers\Shop;

use Alipay\Builder\AlipayPagePayContentBuilder;
use Alipay\Factory;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemSku;
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

    public function pay(Request $request)
    {
        $step = 'pay';
        $order = Auth::user()->boughts()->findOrFail($request->input('order_id'));
        $order->load(['items', 'transaction']);

        return $this->view('shop.order.pay', compact('step', 'order'));
    }

    public function success(Request $request){
        $step = 'success';
        $order = Auth::user()->boughts()->findOrFail($request->input('order_id'));

        return $this->view('shop.order.success',compact('step','order'));
    }

    public function alipay(Request $request){
        $order = Auth::user()->boughts()->findOrFail($request->input('order_id'));
        $transaction = $order->transaction;

        $builder = new AlipayPagePayContentBuilder();
        $builder->setSubject($transaction->subject);
        $builder->setBody($transaction->body);
        $builder->setOutTradeNo($transaction->out_trade_no);
        $builder->setTotalAmount($transaction->amount);
        $builder->setTotalAmount(0.01);

        return Factory::pagePay()
            ->setReturnUrl(url('order/success?order_id='.$order->order_id))
            ->sendRequest($builder->getBizContent());
    }
}
