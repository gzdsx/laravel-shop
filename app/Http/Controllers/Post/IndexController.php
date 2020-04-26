<?php

namespace App\Http\Controllers\Post;


use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index(Request $request){

        abort(404);
        return $this->view('post.index');
    }
}
