<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Models\PostItem;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    /**
     * @param $aid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($aid)
    {
        $post = PostItem::find($aid);
        $items = PostItem::filter(['cate_id' => $post->cate_id])->limit(5)->get();

        return $this->view('h5.post.article', compact('post', 'items'));
    }
}
