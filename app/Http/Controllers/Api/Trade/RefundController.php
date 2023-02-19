<?php

namespace App\Http\Controllers\Api\Trade;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Refund;
use App\Models\RefundAddress;
use App\Models\RefundReason;
use App\Traits\Trade\RefundTrait;
use Illuminate\Http\Request;

class RefundController extends BaseController
{
    use RefundTrait;

    /**
     * @return Refund|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Refund::query();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReasonList()
    {
        $items = RefundReason::get();
        return jsonSuccess([
            'items' => $items,
            'total' => $items->count()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTradeDetail(Request $request)
    {
        $trade_id = $request->input('trade_id');
        $trade = OrderItem::findOrFail($trade_id);
        $order = Order::findOrFail($trade->order_id);

        return jsonSuccess([
            'trade' => $trade,
            'order' => $order
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddress(Request $request)
    {
        $address = RefundAddress::query()->orderByDesc('isdefault')->firstOrFail();
        return jsonSuccess($address);
    }
}
