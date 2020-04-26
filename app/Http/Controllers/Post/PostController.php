<?php

namespace App\Http\Controllers\Post;


use App\Traits\Post\PostTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends BaseController
{
    use PostTrait;

    public function showPosts(Request $request)
    {
        $items = $this->query()->filter($request->all())->orderByDesc('aid')->paginate();
        return $this->view('post.list', compact('items'));
    }

    /**
     * @param Request $request
     * @param $aid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $aid)
    {

        $post = $this->query()->withoutGlobalScopes()->findOrFail($aid);
        if ($post->state != 1){
            if (!Gate::allows('preview', $post)){
                abort(404, __('post.the post has been deleted'));
            }
        }

        $post->increment('views');
        $post->load(['user', 'content', 'media', 'images']);

        $newPostList = $this->query()->limit(10)->orderByDesc('aid')->get();
        $hotPostList = $this->query()->whereNotNull('image')->limit(5)->orderByDesc('views')->get();

        return $this->view('post.article', compact('aid', 'post', 'newPostList', 'hotPostList'));
    }
}
