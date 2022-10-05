<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Traits\Post\PostItemTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends BaseController
{
    use PostItemTrait;

    /**
     * @param Request $request
     * @param $aid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $aid)
    {

        $post = $this->repository()->withoutGlobalScopes()->findOrFail($aid);
        if (!$post->state) {
            if (!Gate::allows('preview', $post)) {
                abort(404, __('post.the post has been deleted'));
            }
        }

        $post->increment('views');
        $post->load(['user', 'content', 'media', 'images']);
        $items = $post->category ? $post->category->posts()->limit(5)->get() : [];

        return $this->view('h5.post.article', compact('aid', 'post', 'items'));
    }
}
