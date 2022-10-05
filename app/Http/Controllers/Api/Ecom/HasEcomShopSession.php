<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/8/27
 * Time: 18:12
 */

namespace App\Http\Controllers\Api\Ecom;


use App\Models\ShopSession;
use Illuminate\Support\Facades\Auth;

trait HasEcomShopSession
{
    /**
     * @return \App\Models\Shop|\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
     */
    protected function shop()
    {
        $session = ShopSession::whereUid(Auth::id())->firstOrFail();
        return $session->shop;
    }
}
