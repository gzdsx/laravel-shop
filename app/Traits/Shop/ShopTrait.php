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

namespace App\Traits\Shop;


use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\Contracts\ShopRepositoryInterface;
use Illuminate\Http\Request;

trait ShopTrait
{
    /**
     * @return ShopRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function shopRepository()
    {
        return app(ShopRepositoryInterface::class);
    }

    /**
     * @return ItemRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function itemRepository(){
        return app(ItemRepositoryInterface::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $shop_id = $request->input('shop_id', 0);
        $shop = $this->shopRepository()->with(['user', 'content'])->findOrFail($shop_id);
        return jsonSuccess(['shop' => $shop]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $items = $this->shopRepository()->filter($request->all())
            ->offset($request->input('offset', 0))
            ->limit($request->input('count', 20))->get();
        return jsonSuccess(['items' => $items]);
    }

    /**
     * @param Request $request
     * @param $shop_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request, $shop_id)
    {
        $shop = $this->shopRepository()->with(['user', 'content'])->findOrFail($shop_id);
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
    public function showShops(Request $request)
    {
        $shops = $this->shopRepository()->filter($request->all())->paginate(20);
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
}
