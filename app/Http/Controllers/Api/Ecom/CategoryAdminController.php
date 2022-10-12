<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EcomProductCategory;
use App\Traits\Ecom\ProductCategoryTrait;
use Illuminate\Http\Request;

class CategoryAdminController extends BaseController
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
