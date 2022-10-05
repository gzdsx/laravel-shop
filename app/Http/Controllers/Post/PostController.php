<?php

namespace App\Http\Controllers\Post;


use App\Traits\Post\PostItemTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends BaseController
{
    use PostItemTrait;

    public function showPosts(Request $request)
    {
        $items = $this->repository()->filter($request->all())->orderByDesc('aid')->paginate();
        return $this->view('post.list', compact('items'));
    }

    /**
     * @param Request $request
     * @param $aid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $aid)
    {

        $post = $this->repository()->withoutGlobalScopes()->findOrFail($aid);
        if (!$post->state){
            if (!Gate::allows('preview', $post)){
                abort(404, __('post.the post has been deleted'));
            }
        }

        $post->increment('views');
        $post->load(['user', 'content', 'media', 'images']);

        $newPostList = $this->repository()->limit(5)->orderByDesc('aid')->get();
        $hotPostList = $this->repository()->whereNotNull('image')->limit(5)->orderByDesc('views')->get();

        return $this->view('post.detail', compact('aid', 'post', 'newPostList', 'hotPostList'));
    }
}
