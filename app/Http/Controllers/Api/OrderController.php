<?php

namespace App\Http\Controllers\Api;


use App\Models\Cart;
use App\Models\ProductItem;
use App\Models\ProductReview;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    protected $orderService;

    public function __construct(Request $request, OrderServiceInterface $orderService)
    {
        parent::__construct($request);
        $this->orderService = $orderService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $itemid = $request->input('itemid');
        $quantity = $request->input('quantity');
        $address = $request->input('address', []);
        $remark = $request->input('remark');
        $sku_id = $request->input('sku_id');

        $product = ProductItem::findOrFail($itemid);
        if ($product->stock < $quantity) {
            abort(400, __('product.insufficient inventory'));
        }

        $product->setAttribute('quantity', $quantity);
        $product->setAttribute('sku_id', $sku_id);

        try {
            $order = $this->orderService->create([$product], $address, $remark);
            $order->load(['buyer', 'shipping', 'items', 'transaction']);
            return jsonSuccess(['order' => $order]);
        } catch (\Exception $exception) {
            return jsonError(400, $exception->getMessage());
        }
    }

    public function settlement(Request $request)
    {
        $items = $request->input('items', []);
        $products = Auth::user()->carts()->whereIn('itemid', $items)->with(['product'])
            ->get()->map(function (Cart $cart) {
                if ($cart->product) {
                    $cart->product->setAttribute('quantity', $cart->quantity);
                    $cart->product->setAttribute('sku_id', $cart->sku_id);
                    return $cart->product;
                }
            });

        try {
            $order = $this->orderService->create($products, $request->input('address', []), $request->input('remark'));
            $order->load(['buyer', 'shipping', 'items', 'transaction']);
            //从购物车删除
            Auth::user()->carts()->whereIn('itemid', $items)->delete();
            return jsonSuccess(['order' => $order]);
        } catch (\Exception $exception) {
            return jsonError(500, $exception->getMessage(), ['trace' => $exception->getTrace()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rate(Request $request)
    {
        $order_id = $request->input('order_id');
        $reviews = $request->input('reviews', []);

        $order = Auth::user()->boughts()->find($order_id);
        if (!$order->buyer_rate) {
            foreach ($reviews as $review) {
                $rev = new ProductReview($review);
                $rev->uid = Auth::id();
                $rev->order_id = $order_id;
                $rev->save();

                if (isset($review['images'])) {
                    foreach ($review['images'] as $image) {
                        $rev->images()->create($image);
                    }
                }
            }
            $order->buyer_rate = 1;
            $order->save();
        }

        return jsonSuccess(['order' => $order]);
    }
}
