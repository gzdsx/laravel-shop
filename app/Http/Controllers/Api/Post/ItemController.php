<?php

namespace App\Http\Controllers\Api\Post;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Post\PostItemTrait;
use Illuminate\Http\Request;

class ItemController extends BaseController
{

    use PostItemTrait;

}
