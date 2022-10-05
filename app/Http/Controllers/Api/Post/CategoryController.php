<?php

namespace App\Http\Controllers\Api\Post;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Post\PostCategoryTrait;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    use PostCategoryTrait;
}
