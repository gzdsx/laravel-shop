<?php

namespace App\Http\Controllers\Api;


use App\Models\Item;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    protected $orderService;
    public function __construct(Request $request, OrderServiceInterface $orderService)
    {
        parent::__construct($request);
        $this->orderService = $orderService;
    }

    public function buynow(Request $request){

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        $itemid = $request->input('itemid');
        $quantity = $request->input('quantity');
        $address_id = $request->input('address_id');
        $remark = $request->input('remark');
        $sku_id = $request->input('sku_id');

        $item = Item::findOrFail($itemid);
        if ($item->stock < $quantity){
            abort(400, __('item.insufficient inventory'));
        }

        $item->setAttribute('quantity',$quantity);
        $item->setAttribute('sku_id',$sku_id);

        try {
            $order = $this->orderService->create([$item], $address_id, $remark);
            $order->load(['buyer','shipping','items','transaction']);
            return ajaxReturn(['order'=>$order]);
        } catch (\Exception $exception){
            return ajaxError(400, $exception->getMessage());
        }
    }

    public function confirm(Request $request){

    }

    public function settlement(Request $request){

    }
}
