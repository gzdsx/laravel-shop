<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Cms\PostManagerTrait;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    use PostManagerTrait;

    protected $authenticate = false;

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\Paginator $items
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPostsView(Request $request, $items)
    {
        $this->assign(array_merge([
            'title' => '',
            'username' => '',
            'catid' => 0,
            'state' => 'all',
            'type' => '',
            'time_begin' => '',
            'time_end' => ''
        ], $request->all()));
        return $this->view('admin.post.posts', [
            'items' => $items,
            'pagination' => $items->appends($request->except('page'))->render(),
            'catlogOptions' => $this->catlogRepository()->fetchOptions(0, $request->input('catid', 0))
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setImage(Request $request)
    {
        $aid = $request->input('aid');
        $image = $request->input('image');
        $this->postRepository()->whereKey($aid)->update(compact('image'));
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @param $post
     * @param $catlogOptions
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPostForm(Request $request, $post, $catlogOptions)
    {
        return $this->view('admin.post.newpost', compact('post', 'catlogOptions'));
    }

    /**
     * @param Request $request
     * @param $postitem
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sendSavedResponse(Request $request, $postitem)
    {
        return $this->messager()->setLinks([
            [trans('common.reedit'), back()->getTargetUrl()],
            [trans('common.continue publish'), admin_url('post/newpost?catid=' . $postitem->catid)],
            [trans('common.back list'), admin_url('post')],
            [trans('common.preview'), $postitem->url, '_blank']
        ])->render();
    }
}
