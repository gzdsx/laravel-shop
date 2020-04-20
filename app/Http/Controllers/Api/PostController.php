<?php

namespace App\Http\Controllers\Api;


use App\Repositories\Contracts\PostRepositoryInterface;
use App\Traits\Cms\PostTrait;
use Illuminate\Http\Request;

class PostController extends BaseController
{

    use PostTrait;

    /**
     * @return bool
     */
    protected function authenticate()
    {
        return false;
    }

    protected function withoutGlobalScopes()
    {
        return false;
    }
}
