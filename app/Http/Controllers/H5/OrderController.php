<?php

namespace App\Http\Controllers\H5;


use App\Models\ProductItem;
use App\Models\ProductSku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $product = ProductItem::findOrFail($request->input('itemid'));
        $sku_id = $request->input('sku_id');
        if ($sku_id) {
            $sku = ProductSku::findOrFail($sku_id);
        } else {
            $sku = [
                'stock' => $product->stock,
                'price' => $product->price,
                'title' => '',
                'sku_id' => 0,
            ];
        }
        $product->load(['skus']);
        $quantity = $request->input('quantity', 1);
        $pay_type = $request->input('pay_type', 1);
        $shipping_type = $request->input('shippin_type', 1);

        return $this->view('h5.order.buynow',
            compact('product', 'sku', 'quantity', 'pay_type', 'shipping_type'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(Request $request)
    {
        $items = Auth::user()->carts()->whereIn('itemid', $request->input('items', []))->get();
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
