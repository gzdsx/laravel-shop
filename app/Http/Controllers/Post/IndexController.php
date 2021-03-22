<?php

namespace App\Http\Controllers\Post;


use App\Models\BlockItem;
use App\Models\PostCategory;
use App\Traits\Post\PostTrait;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    use PostTrait;

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
    public function showPosts(Request $request, $catid)
    {
        $images = BlockItem::where('block_id', 5)->get();
        $categories = PostCategory::allFromCache();
        $category = PostCategory::find($catid);

        $items = $this->repository()->filter(['catid' => $catid])->orderByDesc('aid')->paginate();
        return $this->view('post.index', compact('images', 'categories', 'items', 'catid', 'category'));
    }
}
