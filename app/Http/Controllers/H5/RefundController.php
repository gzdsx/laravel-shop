<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends BaseController
{
    public function index(Request $request)
    {
        return $this->view('h5.refund.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function router(Request $request)
    {
        $item = OrderItem::find($request->input('sub_order_id'));
        $order = $item->order;

        return $this->view('h5.refund.router', compact('item', 'order'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function apply(Request $request)
    {
        if ($refund_id = $request->input('refund_id')) {
            $refund = Refund::find($refund_id);
            $refund->load(['items', 'images', 'order']);
        } else {
            $item = OrderItem::find($request->input('sub_order_id'));
            $refund = new Refund();
            $refund->refund_type = $request->input('refund_type', 1);
            $refund->order()->associate($item->order);
            $refund->items->push($item);
            $refund->refund_amount = $item->total_fee;
            $refund->shipping_fee = 0;
            $refund->receive_state = 1;
            $refund->load(['images']);
        }

        return $this->view('h5.refund.apply', compact('refund'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {

        $refund = Refund::find($request->input('refund_id'));
        $refund->load(['items', 'images', 'order', 'user', 'shipping']);
        return $this->view('h5.refund.detail', compact('refund'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function send(Request $request)
    {
        $refund = Refund::findOrFail($request->input('refund_id'));
        $refund->load(['items', 'images', 'order', 'user', 'shipping']);

        return $this->view('h5.refund.send', compact('refund'));
    }
}
