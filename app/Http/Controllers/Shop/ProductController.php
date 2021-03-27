<?php

namespace App\Http\Controllers\Shop;


use App\Traits\Product\ProductTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends BaseController
{
    use ProductTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {

        return $this->paginate($request);
    }

    /**
     * @param Request $request
     * @param $paginator
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function sendPaginateProductResponse(Request $request, $paginator)
    {
        return $this->view('shop.product.search', ['items' => $paginator]);
    }

    /**
     * @param Request $request
     * @param $itemid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $itemid)
    {
        $product = $this->repository()->withoutGlobalScopes()->findOrFail($itemid);
        if (!$product->on_sale){
            if (Gate::denies('view', $product)) {
                abort(404, __('product.this product has been removed'));
            }
        }
        $product->increment('views');
        $product->load(['content', 'user', 'images', 'skus', 'catePath']);
        $hotSales = $this->repository()->orderByDesc('sold')->limit(5)->get();
        $reviews = $product->buyerReviews()->with(['images', 'user'])->orderByDesc('id')->paginate();
        return $this->view('shop.product.detail', compact('itemid', 'product', 'hotSales', 'reviews'));
    }

    public function reviews(Request $request)
    {

    }
}
