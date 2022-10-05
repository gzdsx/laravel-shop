<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Models\EcomProductCategory;
use App\Traits\Ecom\EcomProductCategoryTrait;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    use EcomProductCategoryTrait;

    /**
     * @return EcomProductCategory|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return EcomProductCategory::query();
    }
}
