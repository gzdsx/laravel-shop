<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Cms\PostTrait;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    use PostTrait;

    protected $authenticate = false;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->view('admin.post.index');
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
//    public function sendSavedResponse(Request $request, $postitem)
//    {
//        return $this->messager()->setLinks([
//            [trans('common.reedit'), back()->getTargetUrl()],
//            [trans('common.continue publish'), admin_url('post/newpost?catid=' . $postitem->catid)],
//            [trans('common.back list'), admin_url('post')],
//            [trans('common.preview'), $postitem->url, '_blank']
//        ])->render();
//    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        if ($aid = $request->input('aid')) {
            $post = $this->postRepository()->findOrFail($aid);
        } else {
            $post = $this->postRepository()->make([]);
        }
        $post->load(['content', 'images', 'media']);
        return ajaxReturn(['post' => $post]);
    }
}
