<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Models\EcomProductCategory;
use App\Traits\Ecom\ProductCategoryTrait;
use Illuminate\Http\Request;

class ProductCategoryController extends BaseController
{
    use ProductCategoryTrait;

    /**
     * @return EcomProductCategory|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return EcomProductCategory::query();
    }
}
