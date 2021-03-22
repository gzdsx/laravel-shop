<?php

namespace App\Http\Controllers\Shop;

use Alipay\Builder\AlipayPagePayContentBuilder;
use Alipay\Factory;
use App\Models\Cart;
use App\Models\ProductItem;
use App\Models\ProductSku;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function buynow(Request $request)
    {
        $step = 'confirm';
        $item = ProductItem::findOrFail($request->input('itemid'));
        $sku_id = $request->input('sku_id');
        if ($sku_id) {
            $sku = ProductSku::findOrFail($sku_id);
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
        return $this->view('shop.order.confirm', compact('items', 'addresses', 'step'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pay(Request $request)
    {
        $step = 'pay';
        $order = Auth::user()->boughts()->findOrFail($request->input('order_id'));
        $order->load(['items', 'transaction']);

        return $this->view('shop.order.pay', compact('step', 'order'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payResult(Request $request)
    {
        $step = 'success';
        $order = Auth::user()->boughts()->findOrFail($request->input('order_id'));

        return $this->view('shop.order.result', compact('step', 'order'));
    }

    /**
     * @param Request $request
     * @return array|mixed|string
     */
    public function alipay(Request $request)
    {
        $order = Order::findOrFail($request->input('order_id'));
        $transaction = $order->transaction;

        $builder = new AlipayPagePayContentBuilder();
        $builder->setSubject($transaction->subject);
        $builder->setBody($transaction->body ?: $transaction->subject);
        $builder->setOutTradeNo($transaction->out_trade_no);
        $builder->setTotalAmount($transaction->amount);
        //$builder->setTotalAmount(0.01);

        return Factory::pagePay()
            ->setReturnUrl(url('order/query/alipay'))
            ->sendRequest($builder->getBizContent());
    }
}
