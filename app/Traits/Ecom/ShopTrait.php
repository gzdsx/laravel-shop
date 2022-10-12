<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-20
 * Time: 17:58
 */

namespace App\Traits\Ecom;


use App\Models\EcomShop;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait ShopTrait
{
    /**
     * @return EcomShop|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return EcomShop::withGlobalScope('avalaible', function (Builder $builder) {
            return $builder->where('closed', 0)->where('auth_state', 1);
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('shop_id'));
        $model->load(['seller', 'images']);
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository()->filter($request->all());

        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 20))->get()
        ]);
    }

    /**
     * @param Request $request
     * @param $shop_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request, $shop_id)
    {
        $shop = $this->repository()->findOrFail($shop_id);
        $shop->load(['seller', 'images']);
        return $this->showDetailView($request, $shop);
    }

    /**
     * @param Request $request
     * @param $shop
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showDetailView(Request $request, $shop)
    {
        return jsonSuccess(['shop' => $shop]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showShopList(Request $request)
    {
        $shops = $this->repository()->filter($request->all())->paginate(20);
        return $this->showShopsView($request, $shops);
    }

    /**
     * @param Request $request
     * @param $shops
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showShopsView(Request $request, $shops)
    {
        return jsonSuccess(['shops' => $shops]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $shop = new EcomShop();
        $shop->fill($request->input('shop', []));
        //$shop->seller()->associate(Auth::id());
        $shop->save();

        return jsonSuccess(['shop' => $shop]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $this->repository()->whereKey($request->input('shop_id'))->update($request->input('data', []));
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->get()->each->delete();
        return jsonSuccess();
    }
}
