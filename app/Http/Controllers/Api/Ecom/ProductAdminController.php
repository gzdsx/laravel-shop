<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\ProductItem;
use App\Traits\Ecom\ProductTrait;
use Illuminate\Http\Request;

class ProductAdminController extends BaseController
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
