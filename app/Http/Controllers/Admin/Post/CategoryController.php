<?php

namespace App\Http\Controllers\Admin\Post;


use App\Http\Controllers\Admin\BaseController;
use App\Traits\Post\PostCategoryTrait;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    use PostCategoryTrait;
}
