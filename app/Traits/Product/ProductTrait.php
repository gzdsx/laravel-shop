<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/23
 * Time: 11:47 下午
 */

namespace App\Traits\Product;


use App\Models\ProductItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait ProductTrait
{

    /**
     * @return ProductItem|Builder
     */
    protected function repository()
    {
        return ProductItem::withGlobalScope('available', function (Builder $builder) {
            return $builder->where('on_sale', 1);
        });
    }

    /**
     * @param $itemid
     * @return ProductItem|ProductItem[]|Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    protected function findItem($itemid)
    {
        $item = $this->repository()->findOrFail($itemid);
        $item->load(['images', 'props', 'skus', 'content', 'catePath']);
        return $item;
    }

    /**
     * @param $itemid
     * @return ProductItem|ProductItem[]|Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    protected function getItemById($itemid)
    {
        return $this->findItem($itemid);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $product = $this->findItem($request->input('itemid'));
        return $this->sendGetProductResponse($request, $product);
    }

    /**
     * @param Request $request
     * @param ProductItem|\Illuminate\Database\Eloquent\Builder $product
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendGetProductResponse(Request $request, $product)
    {
        return jsonSuccess(['product' => $product]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 10);
        $query = $this->repository()->filter($request->all());
        $total = $query->count();
        $items = $query->offset($offset)->limit($count)->orderByDesc('itemid')->get();
        return $this->sendBatchGetProductResponse($request, $items, $total);
    }

    /**
     * @param Request $request
     * @param ProductItem[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection $items
     * @param int $total
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchGetProductResponse(Request $request, $items, $total)
    {
        return jsonSuccess(compact('total', 'items'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paginate(Request $request)
    {
        $paginator = $this->repository()->filter($request->all())->orderByDesc('itemid')->paginate($request->input('pagesize', 15));
        return $this->sendPaginateProductResponse($request, $paginator);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $paginator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendPaginateProductResponse(Request $request, $paginator)
    {
        return jsonSuccess([
            'total' => $paginator->total(),
            'currentPage' => $paginator->currentPage(),
            'lastPage' => $paginator->lastPage(),
            'pageSize' => $paginator->perPage(),
            'items' => $paginator->items()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newProduct = collect($request->input('product', []));
        $product = $this->repository()->findOrNew($request->input('itemid'));
        $product->fill($newProduct->all())->save();

        if ($newProduct->has('content')) {
            $product->content->fill($newProduct->get('content', []))->save();
        }

        if ($newProduct->has('cates')) {
            $product->catePath()->sync($newProduct->get('cates', []));
        }

        if ($newProduct->has('images')) {
            $this->saveImages($product, $newProduct->get('images', []));
        }

        if ($newProduct->has('skus')) {
            $this->saveSkus($product, $newProduct->get('skus', []));
        }
        return $this->sendSavedItemResponse($request, $product);
    }

    /**
     * @param ProductItem $product
     * @param array $images
     */
    protected function saveImages(&$product, $images)
    {
        $images = collect($images);
        if ($firstImg = $images->first()) {
            $product->thumb = $firstImg['thumb'] ?? null;
            $product->image = $firstImg['image'] ?? null;
            $product->save();
        }
        $product->images()->whereNotIn('id', $images->pluck('id'))->delete();
        foreach ($images as $k => $image) {
            $newImage = $product->images()->findOrNew($image['id'] ?? 0);
            $newImage->fill($image);
            $newImage->displayorder = $k;
            $newImage->save();
        }
    }

    /**
     * @param ProductItem $product
     * @param array $skus
     */
    protected function saveSkus($product, $skus)
    {
        $skus = collect($skus);
        $product->skus()->whereNotIn('sku_id', $skus->pluck('sku_id'))->delete();
        foreach ($skus as $sku) {
            $newSku = $product->skus()->findOrNew($sku['sku_id'] ?? 0);
            $newSku->fill($sku)->save();
        }
    }


    /**
     * @param Request $request
     * @param ProductItem|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model $product
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSavedItemResponse(Request $request, $product)
    {
        return jsonSuccess(['product' => $product]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        foreach ($this->repository()->whereKey($request->input('items', []))->get() as $product) {
            $product->delete();
        }
        return $this->sendDeletedItemResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendDeletedItemResponse(Request $request)
    {
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $items = $request->input('items', []);
        $data = $request->input('data', []);
        foreach ($this->repository()->whereKey($items)->get() as $product) {
            $product->fill($data)->save();
        }

        return $this->sendBatchUpdatedItemResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchUpdatedItemResponse(Request $request)
    {
        return jsonSuccess();
    }
}
