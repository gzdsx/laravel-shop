<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Controllers\Admin\BaseController;
use App\Models\EcomProductItem;
use App\Models\CommonMaterial;
use App\Models\Order;
use App\Models\PostItem;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function posts(Request $request)
    {
        return jsonSuccess(['items' => PostItem::limit(5)->orderByDesc('aid')->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function stats(Request $request)
    {
        return jsonSuccess([
            'users' => User::count(),
            'posts' => PostItem::count(),
            'products' => EcomProductItem::count(),
            'materials' => CommonMaterial::count(),
            'orders' => Order::count()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function newusers(Request $request)
    {
        return jsonSuccess(['items' => User::orderByDesc('uid')->limit(10)->get()]);
    }
}
