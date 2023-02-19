<?php

namespace App\Http\Controllers\Post;


use App\Models\CommonBlockItem;
use App\Models\PostCategory;
use App\Traits\Post\PostItemTrait;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    use PostItemTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->showPosts($request, 0);
    }

    /**
     * @param Request $request
     * @param $catid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPosts(Request $request, $cate_id)
    {
        $images = CommonBlockItem::whereBlockId(1)->get();
        $categories = PostCategory::allFromCache();
        $category = PostCategory::find($cate_id);

        $items = $this->repository()->filter(['cate_id' => $cate_id])->orderByDesc('aid')->paginate();
        return $this->view('post.index', compact('images', 'categories', 'items', 'cate_id', 'category'));
    }
}
