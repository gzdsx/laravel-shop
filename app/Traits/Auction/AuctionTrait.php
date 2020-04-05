<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-26
 * Time: 15:03
 */

namespace App\Traits\Auction;


use App\Events\OrderEvent;
use App\Exceptions\UserRequestException;
use App\Models\Order;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\Contracts\ShopRepositoryInterface;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AuctionTrait
{
    /**
     * @return OrderServiceInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function orderService()
    {
        return app(OrderServiceInterface::class);
    }

    /**
     * @return ItemRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function itemRepository()
    {
        return app(ItemRepositoryInterface::class);
    }

    /**
     * @return ShopRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function shopRepository()
    {
        return app(ShopRepositoryInterface::class);
    }

    /**
     * @return CartRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function cartRepository()
    {
        return app(CartRepositoryInterface::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function prepareItemFormAuction(Request $request)
    {
        $itemid = $request->input('itemid');
        $quantity = $request->input('quantity', 1);
        $item = $this->itemRepository()->findOrFail($itemid);
        if (!Auth::user()->can('buy', $item)) {
            abort(403, trans('auction.can not buy products that you sell yourself'));
        }
        if ($item->stock < $quantity) {
            abort(403, trans('item.insufficient inventory'));
        } else {
            $item->setAttribute('quantity', $quantity);
        }
        return $item;
    }

    /**
     * @param Request $request
     * @return \Exception|\Illuminate\Http\JsonResponse
     * @throws UserRequestException
     */
    public function createOrder(Request $request)
    {
        $item = $this->prepareItemFormAuction($request);
        $address_id = $request->input('address_id', 0);
        $address = Auth::user()->addresses()->findOrFail($address_id);
        $order = $this->orderService()->create([$item], $address, [
            'buyer_message' => $request->input('buyer_message', ''),
            'pay_type' => $request->input('pay_type', 1)
        ]);

        event(new OrderEvent($order,'created'));
        return $this->sendOrderCreatedResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendOrderCreatedResponse(Request $request, Order $order)
    {
        return ajaxReturn(['order' => $order]);
    }

    /**
     * @param Request $request
     * @param CartRepositoryInterface $cartRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function settlement(Request $request, CartRepositoryInterface $cartRepository)
    {
        $cartList = $cartRepository->with('item')->where('uid', Auth::id())->whereIn('itemid', $request->input('items', []))->get();
        $items = [];
        foreach ($cartList as $cart) {
            if ($cart->item) {
                $cart->item->setAttribute('quantity', $cart->quantity);
                $items[] = $cart->item;
            }
        }
        $address = Auth::user()->addresses()->findOrFail($request->input('address_id'));
        $order = $this->orderService()->create($items, $address, ['buyer_message' => $request->input('buyer_message')]);
        $this->cartRepository()->where('uid', Auth::id())->whereIn('itemid', $request->input('items', []))->delete();

        event(new OrderEvent($order,'created'));
        return $this->sendSellementedResponse($request, $order);
    }

    /**
     * @param Request $request
     * @param $orders
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSellementedResponse(Request $request, $order)
    {
        return ajaxReturn(['order' => $order]);
    }
}
