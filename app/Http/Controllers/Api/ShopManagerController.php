<?php

namespace App\Http\Controllers\Api;

use App\Traits\Mall\ShopManagerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopManagerController extends BaseController
{
    use ShopManagerTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return ajaxReturn(['shop' => $this->shopRepository()->where('uid', Auth::id())->first()]);
    }
}
