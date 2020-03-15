<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-17
 * Time: 22:58
 */

namespace App\Traits\Cms;


use App\Repositories\Contracts\PostCatlogRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

trait PostManagerTrait
{

    public function authenticate()
    {
        return property_exists($this, 'authenticate') ? $this->authenticate : true;
    }

    /**
     * @return PostRepositoryInterface
     */
    protected function postRepository()
    {
        return app(PostRepositoryInterface::class)->withoutGlobalScopes();
    }

    /**
     * @return PostCatlogRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function catlogRepository()
    {
        return app(PostCatlogRepositoryInterface::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $aid = $request->input('aid', 0);
        $post = $request->post('post', []);
        $content = $request->post('content');
        $media = $request->post('media');
        $images = $request->post('images');

        if (!$post['summary']) {
            if ($content) {
                $post['summary'] = mbsubstr(strip_html($content['content']), 300);
            }
        }

        if ($aid) {
            $postitem = $this->postRepository()->findOrFail($aid);
            if ($postitem) $postitem->update($post);
        } else {
            $postitem = $this->postRepository()->create($post);
        }

        if (is_array($content)) $this->postRepository()->updateContent($postitem, $content);
        if (is_array($images)) $this->postRepository()->updateImages($postitem, $images);
        if (is_array($media)) $this->postRepository()->updateMedia($postitem, $media);

        return $this->sendSavedResponse($request, $postitem);
    }


    /**
     * @param Request $request
     * @param $post
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSavedResponse(Request $request, $post)
    {
        return ajaxReturn(['post' => $post]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $items = $request->input('items', []);
        if ($this->authenticate()) {
            $this->postRepository()->where('uid', Auth::id())->whereKey($items)->delete();
        } else {
            $this->postRepository()->whereKey($items)->delete();
        }

        return $this->sendBatchDeletedResponse($request);
    }

    protected function sendBatchDeletedResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchResolve(Request $request)
    {
        $items = $request->input('items', []);
        $this->postRepository()->whereKey($items)->update(['state' => 1]);
        return $this->sendBatchUpdatedResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchReject(Request $request)
    {
        $items = $request->input('items', []);
        $this->postRepository()->whereKey($items)->update(['state' => 2]);
        return $this->sendBatchUpdatedResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchMove(Request $request)
    {
        $items = $request->input('items', []);
        $target = $request->input('target', 0);
        $this->postRepository()->whereKey($items)->update(['catid' => $target]);
        return $this->sendBatchUpdatedResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchUpdatedResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function newpost(Request $request)
    {

        $aid = $request->get('aid', 0);
        if ($aid) {
            if ($this->authenticate()) {
                $post = $this->postRepository()->where('uid', Auth::id())->findOrFail($aid);
            } else {
                $post = $this->postRepository()->findOrFail($aid);
            }
        } else {
            $post = $this->postRepository()->make([
                'catid' => $request->get('catid', 0),
                'type' => $request->input('type', 'article'),
                'from' => env('APP_NAME'),
                'fromurl' => env('APP_URL'),
                'created_at' => Date::now(),
                'author' => Auth::user()->username
            ]);
        }

        $catlogOptions = $this->catlogRepository()->fetchOptions(0, $post->catid);
        return $this->showPostForm($request, $post, $catlogOptions);
    }

    /**
     * @param Request $request
     * @param $post
     * @param $catlogOptions
     * @return mixed
     */
    protected function showPostForm(Request $request, $post, $catlogOptions)
    {
        return $this->view('admin.post.newpost', compact('aid', 'post', 'catlogOptions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showPosts(Request $request)
    {
        return $this->showPostsView($request, $this->postRepository()->filter($request->all())->orderByDesc('aid')->paginate());
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\Paginator $items
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showPostsView(Request $request, $items)
    {
        return ajaxReturn(['items' => $items]);
    }
}
