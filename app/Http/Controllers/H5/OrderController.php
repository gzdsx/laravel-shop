<?php

namespace App\Http\Controllers\H5;


use Illuminate\Http\Request;

class OrderController extends BaseController
{

    public function index(Request $request)
    {
        return $this->view('h5.order.index');
    }

    public function detail(Request $request)
    {
        return $this->view('h5.order.detail');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function buynow(Request $request)
    {
        $itemid = $request->input('itemid');
        $sku_id = $request->input('sku_id', 0);
        $quantity = $request->input('quantity', 1);
        $pay_type = $request->input('pay_type', 1);
        $shipping_type = $request->input('shippin_type', 1);

        return $this->view('h5.order.buynow',
            compact('quantity', 'pay_type', 'shipping_type', 'sku_id', 'itemid'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(Request $request)
    {
        $items = $request->input('items', []);
        return $this->view('h5.order.confirm', compact('items'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rate(Request $request)
    {
        return $this->view('h5.order.rate');
    }
}
