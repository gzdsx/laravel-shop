<?php

namespace App\Http\Controllers\Admin;


use App\Models\ProductItem;
use App\Traits\Product\ProductTrait;

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
