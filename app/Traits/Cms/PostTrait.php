<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-20
 * Time: 03:22
 */

namespace App\Traits\Cms;


use App\Repositories\Contracts\PostCatlogRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;

trait PostTrait
{
    /**
     * @return PostRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function postRepository()
    {
        return app(PostRepositoryInterface::class);
    }

    /**
     * @return PostCatlogRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function catlogRepository(){
        return app(PostCatlogRepositoryInterface::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $post = $this->postRepository()->with(['content', 'media', 'images', 'catlog', 'user'])->findOrFail($request->input('aid'));
        return ajaxReturn(['post' => $post]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        $items = $this->postRepository()->filter($request->all())->orderByDesc('aid')->fetch($offset, $count);
        return ajaxReturn(['items' => $items]);
    }

    /**
     * @param Request $request
     * @param $aid
     * @return mixed
     */
    public function detail(Request $request, $aid){
        $post = $this->postRepository()->with(['content', 'media', 'images', 'catlog', 'user'])->find($aid);
        return $this->showDetailView($request, $post);
    }

    /**
     * @param Request $request
     * @param $post
     * @return mixed
     */
    protected function showDetailView(Request $request, $post){
        return $post;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function showPosts(Request $request){
        $items = $this->postRepository()->filter($request->all())->orderByDesc('aid')->paginate(15);
        return $this->showPostsView($request, $items);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\Paginator $items
     * @return mixed
     */
    protected function showPostsView(Request $request, $items){
        return $items;
    }
}
