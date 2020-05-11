<?php

namespace App\Http\Controllers\Post;


use Illuminate\Http\Request;

class IndexController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->view('post.index');
    }
}
