<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Models\EcomProductItem;
use App\Traits\Ecom\ProductTrait;
use Illuminate\Http\Request;

class ProductItemController extends BaseController
{
    use ProductTrait;

    /**
     * @return EcomProductItem|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return EcomProductItem::query();
    }
}
