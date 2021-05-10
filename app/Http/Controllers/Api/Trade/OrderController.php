<?php

namespace App\Http\Controllers\Api\Trade;


use App\Http\Controllers\Api\BaseController;
use App\Models\ProductItem;
use App\Models\ProductReview;
use App\Services\Contracts\OrderServiceInterface;
use App\Traits\Product\HasFreight;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    use HasFreight;

    protected $orderService;

    public function __construct(Request $request, OrderServiceInterface $orderService)
    {
        parent::__construct($request);
        $this->orderService = $orderService;
    }

    public function buynow(Request $request)
    {
        $itemid = $request->input('itemid');
        $sku_id = $request->input('sku_id', 0);
        $quantity = $request->input('quantity', 1);

        $product = ProductItem::findOrFail($itemid);
        if (!$sku = $product->skus()->find($sku_id)) {
            $sku = $product->skus()->make([
                'stock' => $product->stock,
                'price' => $product->price
            ]);
        }

        if ($quantity > $sku->stock) {
            abort(403, trans('product.insufficient inventory'));
        }

        $product_fee = bcmul($sku->price, $quantity, 2);
        $shipping_fee = $this->computeFreight($product->freight_template_id, $quantity, $product_fee);
        $discount_fee = '0.00';
        return jsonSuccess([
            'result' => [
                'sku' => $sku,
                'product' => $product,
                'quantity' => $quantity,
                'product_fee' => $product_fee,
                'shipping_fee' => bcadd($shipping_fee, 0, 2),
                'discount_fee' => bcadd($discount_fee, 0, 2),
                'order_fee' => bcsub(bcadd($product_fee, $shipping_fee, 2), $discount_fee, 2)
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $itemid = $request->input('itemid');
        $quantity = $request->input('quantity', 1);
        $sku_id = $request->input('sku_id', 0);
        $address = $request->input('address', []);
        $remark = $request->input('remark');
        $pay_type = $request->input('pay_type', 1);
        $shipping_type = $request->input('shipping_type', 1);

        $product = ProductItem::findOrFail($itemid);
        if (!$sku = $product->skus()->find($sku_id)) {
            $sku = $product->skus()->make([
                'stock' => $product->stock,
                'price' => $product->price
            ]);
        }

        if ($quantity > $sku->stock) {
            abort(403, trans('product.insufficient inventory'));
        }

        $item = [
            'sku' => $sku,
            'product' => $product,
            'quantity' => $quantity,
        ];

        try {
            $order = $this->orderService->create([$item], $address, null, compact('remark', 'pay_type', 'shipping_type'));
            $order->load(['buyer', 'shipping', 'items', 'transaction']);
            return jsonSuccess(['order' => $order]);
        } catch (\Exception $exception) {
            return jsonError(403, $exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request)
    {
        $product_fee = 0;
        $shipping_fee = 0;
        $discount_fee = 0;
        $total_count = 0;
        $items = Auth::user()->carts()->with(['product', 'sku'])
            ->whereHas('product', function (Builder $builder) {
                return $builder->where('on_sale', 1);
            })->whereIn('itemid', $request->input('items', []))
            ->get()
            ->map(function ($cart) use (&$product_fee, &$shipping_fee, &$total_count) {
                $product = $cart->product;
                $quantity = $cart->quantity;

                if (!$sku = $cart->sku) {
                    $sku = $product->skus()->make([
                        'price' => $product->price,
                        'stock' => $product->stock
                    ]);
                }

                $simple_fee = bcmul($sku->price, $quantity, 2);
                $product_fee = bcadd($product_fee, $simple_fee, 2);
                $freight = $this->computeFreight($product->freight_template_id, $quantity, $product_fee);
                $shipping_fee = bcadd($shipping_fee, $freight, 2);
                $total_count = bcadd($total_count, $quantity);

                return [
                    'sku' => $sku,
                    'product' => $product,
                    'quantity' => $quantity,
                    'total_fee' => bcmul($sku->price, $quantity)
                ];
            });


        $discount_fee = bcadd($discount_fee, 0, 2);
        $total_fee = bcadd($product_fee, $shipping_fee, 2);
        $order_fee = bcsub($total_fee, $discount_fee, 2);
        return jsonSuccess([
            'result' => compact('items', 'product_fee', 'shipping_fee', 'discount_fee', 'total_fee', 'order_fee', 'total_count')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function settlement(Request $request)
    {
        $address = $request->input('address', []);
        $remark = $request->input('remark');
        $pay_type = $request->input('pay_type', 1);
        $shipping_type = $request->input('shipping_type', 1);
        $items = Auth::user()->carts()->with(['product', 'sku'])
            ->whereHas('product', function (Builder $builder) {
                return $builder->where('on_sale', 1);
            })->whereIn('itemid', $request->input('items', []))
            ->get()
            ->map(function ($cart) {
                $product = $cart->product;
                $quantity = $cart->quantity;
                if (!$sku = $cart->sku) {
                    $sku = $product->skus()->make([
                        'price' => $product->price,
                        'stock' => $product->stock
                    ]);
                }

                return [
                    'sku' => $sku,
                    'product' => $product,
                    'quantity' => $quantity
                ];
            });

        try {
            $order = $this->orderService->create($items, $address, null, compact('remark', 'pay_type', 'shipping_type'));
            $order->load(['buyer', 'shipping', 'items', 'transaction']);
            //从购物车删除
            Auth::user()->carts()->whereIn('itemid', $request->input('items', []))->delete();
            return jsonSuccess(['order' => $order]);
        } catch (\Exception $exception) {
            return jsonError(403, $exception->getMessage());
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
