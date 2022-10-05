<?php

namespace App\Http\Controllers\Api\Post;


use App\Http\Controllers\Api\BaseController;
use App\Traits\Post\PostSubscribeTrait;

class SubscribeController extends BaseController
{
    use PostSubscribeTrait;
}
