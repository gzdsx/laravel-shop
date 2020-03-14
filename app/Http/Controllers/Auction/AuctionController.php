<?php

namespace App\Http\Controllers\Auction;

use App\Models\Order;
use App\Traits\Auction\AuctionTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuctionController extends Controller
{
    use AuctionTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \App\Exceptions\UserRequestException
     */
    public function buyNow(Request $request)
    {
        $step = 'confirmOrder';
        $itemid = $request->input('itemid');
        $item = $this->prepareItemFormAuction($request);

        $quantity = $request->input('quantity', 1);
        $pay_type = $request->input('pay_type', 1);
        $shipping_type = $request->input('shipping_type', 1);

        $this->assign(compact('itemid', 'quantity', 'pay_type', 'shipping_type'));
        $total_fee = $item->price * $quantity;
        $shop = $item->shop;

        return $this->view('auction.buynow', compact('item', 'shop', 'total_fee', 'step'));
    }

    protected function sendOrderCreatedResponse(Request $request, Order $order)
    {
        return redirect('auction/pay?order_id=' . $order->order_id);
    }

    public function confirmOrder(Request $request)
    {

        $items = $this->cartRepository()->with(['item', 'shop'])
            ->whereIn('itemid', $request->input('items', []))
            ->where('uid', $request->user()->uid)->get();
        $shops = [];
        foreach ($items as $item) {
            if (!isset($shops[$item->shop_id])) {
                $shops[$item->shop_id] = [
                    'shop' => $item->shop,
                    'items' => []
                ];
            }

            $item->item->setAttribute('quantity', $item->quantity);
            $shops[$item->shop_id]['items'][] = $item->item;
        }

        return $this->view('auction.confirmorder', [
            'step'=>'confirmOrder',
            'shops'=>array_values($shops)
        ]);
    }

    protected function sendSellementedResponse(Request $request, $orders)
    {
        return redirect('user/bought');
    }
}
