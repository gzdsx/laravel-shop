<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Models\ProductCategory;
use App\Traits\Ecom\ProductCategoryTrait;
use Illuminate\Http\Request;

class ProductCategoryController extends BaseController
{
    use ProductCategoryTrait;

    /**
     * @return ProductCategory|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return ProductCategory::query();
    }
}
