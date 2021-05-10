<?php

namespace App\Http\Controllers\Api\Post;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Post\PostCollectTrait;

class CollectController extends BaseController
{
    use PostCollectTrait;
}
