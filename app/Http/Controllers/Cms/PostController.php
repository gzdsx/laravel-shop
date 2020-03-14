<?php

namespace App\Http\Controllers\Cms;

use App\Traits\Cms\PostTrait;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    use PostTrait;

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->showPosts($request);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\Paginator $items
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showPostsView(Request $request, $items)
    {
        $this->assign($request->all());
        return $this->view('cms.post.index', [
            'items' => $items,
            'pagination' => $items->appends($request->except('page'))->render(),
        ]);
    }

    /**
     * @param Request $request
     * @param $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function showDetailView(Request $request, $post)
    {
        return $this->view('cms.post.' . $post->type, [
            'aid' => $post->aid,
            'post' => $post,
            'keywords' => $post->tags ? @implode(',', $post->tags) : setting('keywords'),
            'description' => $post->summary ? $post->summary : setting('description'),
            'newPostList' => $this->postRepository()->orderByDesc('aid')->fetch(0, 10),
            'hotPostList' => $this->postRepository()->orderByDesc('views')->fetch(0, 10),
        ]);
    }
}
