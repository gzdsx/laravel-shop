<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/5/31
 * Time: 03:08
 */

namespace App\Traits\Ecom;


use App\Models\EcomProductItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait ProductTrait
{
    /**
     * @return Builder|EcomProductItem
     */
    protected function repository()
    {
        return EcomProductItem::withGlobalScope('available', function (Builder $builder) {
            return $builder->where('state', 1);
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('itemid'));
        $model->increment('views');
        $model->load(['skus']);
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 10);
        $query = $this->repository()->filter($request->all());

        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($offset)->take($count)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $model = $this->repository()->findOrNew($request->input('itemid'));
            $model->fill($request->input('item', []));
            if (!$model->seller_id) {
                $model->seller()->associate(Auth::id());
            }

            if (!$model->has_sku_attr) {
                $model->attrs = [];
            }
            $model->save();

            if ($request->has('content')) {
                $content = $model->content()->firstOrNew();
                $content->content = $request->input('content');
                $content->save();
            }

            if ($request->has('images')) {
                $images = collect($request->input('images', []));
                $model->images()->whereNotIn('id', $images->pluck('id'))->delete();

                foreach ($images as $k => $v) {
                    $v['sort_num'] = $k;
                    $model->images()->updateOrCreate(['id' => $v['id'] ?? 0], $v);
                }

                if ($first = $images->first()) {
                    $model->thumb = $first['thumb'] ?? null;
                    $model->image = $first['image'] ?? null;
                    $model->save();
                }
            }

            if ($model->has_sku_attr) {
                if ($request->has('skus')) {
                    $skus = $request->input('skus', []);
                    $model->skus()->whereNotIn('sku_id', collect($skus)->pluck('sku_id'))->delete();
                    foreach ($skus as $sku) {
                        $sku['pin_price'] = $sku['pin_price'] ?? 0;
                        $model->skus()->updateOrCreate(['sku_id' => $sku['sku_id'] ?? 0], $sku);
                    }
                }
            } else {
                $model->skus()->delete();
            }

            return jsonSuccess($model);
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {

        if ($model = $this->repository()->fill($request->input('itemid'))) {
            $model->delete();
        }

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->each->delete();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $ids = $request->input('ids', []);
        $data = $request->input('data', []);
        foreach ($this->repository()->whereKey($ids)->get() as $product) {
            $product->fill($data)->save();
        }

        return jsonSuccess();
    }

    public function toggle(Request $request)
    {
        $product = $this->repository()->find($request->input('itemid'));
        $product->state = $product->state == 1 ? 0 : 1;
        $product->save();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function groups(Request $request)
    {
        $product = $this->repository()->find($request->input('itemid'));
        $query = $product->groups()->whereHas('order', function (Builder $builder) {
            return $builder->where('pay_state', 1);
        });

        if (Auth::check()) {
            $query->whereNotIn('uid', [Auth::id()]);
        }

        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->orderByDesc('order_id')->get()
        ]);
    }
}
