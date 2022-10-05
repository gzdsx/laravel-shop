<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Models\ProductItem;
use App\Traits\Ecom\ProductTrait;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    use ProductTrait;

    /**
     * @return ProductItem|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return ProductItem::query();
    }
}
