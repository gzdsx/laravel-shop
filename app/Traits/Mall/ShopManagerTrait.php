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
 * Time: 14:28
 */

namespace App\Traits\Mall;


use App\Repositories\Contracts\ShopRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait ShopManagerTrait
{
    /**
     * @return bool
     */
    protected function authenticate()
    {
        return true;
    }

    /**
     * @return ShopRepositoryInterface
     */
    protected function shopRepository()
    {
        return app(ShopRepositoryInterface::class)->withoutGlobalScopes();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showShops(Request $request)
    {
        $shops = $this->shopRepository()->filter($request->all())->orderByDesc('shop_id')->paginate();
        return $this->showShopsView($request, $shops);
    }

    /**
     * @param Request $request
     * @param $shops
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showShopsView(Request $request, $shops)
    {
        return ajaxReturn(['shops' => $shops]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $shops = $request->input('shops', []);
        $this->shopRepository()->whereKey($shops)->delete();
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchClose(Request $request)
    {
        $shops = $request->input('shops', []);
        $this->shopRepository()->whereKey($shops)->update(['closed' => 1]);

        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchOpen(Request $request)
    {
        $shops = $request->input('shops', []);
        $this->shopRepository()->whereKey($shops)->update(['closed' => 0]);

        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $newshop = $request->input('shop', []);
        if ($newshop['shop_name'] && $newshop['phone']) {
            $shop = $this->shopRepository()->updateOrCreate(['uid' => Auth::id()], $newshop);
            $this->shopRepository()->updateContent($shop, $request->input('content',[]));
        }

        return $this->sendSaveResponse($request, $shop);
    }

    /**
     * @param Request $request
     * @param $shop
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSaveResponse(Request $request, $shop){
        return ajaxReturn(['shop'=>$shop]);
    }
}
