<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Order;
use App\Models\PostItem;
use App\Models\ProductItem;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function posts(Request $request)
    {
        return jsonSuccess(['items' => PostItem::limit(5)->orderByDesc('aid')->get()]);
    }

    public function counts(Request $request)
    {
        return jsonSuccess(['counts' => [
            'user' => User::count(),
            'post' => PostItem::count(),
            'product' => ProductItem::count(),
            'material' => Material::count(),
            'order' => Order::count(),
            'video' => Video::count()
        ]]);
    }

    public function newuser(Request $request)
    {
        return jsonSuccess(['items' => User::orderByDesc('uid')->limit(10)->get()]);
    }
}
