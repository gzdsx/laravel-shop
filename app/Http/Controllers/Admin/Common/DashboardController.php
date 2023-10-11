<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Controllers\Admin\BaseController;
use App\Models\EcomProductItem;
use App\Models\CommonMaterial;
use App\Models\Order;
use App\Models\PostItem;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function posts(Request $request)
    {
        return json_success(['items' => PostItem::limit(5)->orderByDesc('id')->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function stats(Request $request)
    {
        return json_success([
            'users' => User::count(),
            'posts' => PostItem::count(),
            'materials' => CommonMaterial::count()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function users(Request $request)
    {
        return json_success(['items' => User::orderByDesc('uid')->limit(10)->get()]);
    }
}
