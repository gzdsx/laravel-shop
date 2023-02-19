<?php

namespace App\Http\Controllers\Ecom;

use App\Http\Controllers\Controller;
use App\Models\CommonBlockItem;
use App\Models\EcomProductItem;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $slides = CommonBlockItem::whereBlockId(1)->get();
        $products = EcomProductItem::query()->orderByDesc('itemid')->limit(15)->get();
        return $this->view('ecom.index', compact('slides','products'));
    }
}
