<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PostItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    protected $navName = 'post';

    /**
     * @return PostItem|Builder
     */
    protected function repository()
    {
        return PostItem::withGlobalScope('avalaible', function (Builder $builder) {
            return $builder->where('status', PostItem::STATUS_PUBLISH);
        });
    }

    public function index(Request $request, $cate = 0)
    {

        $category = Category::findOrNew($cate);
        $items = $this->repository()->filter(['cate' => $cate, 'sort' => 'time-desc'])->paginate();

        return $this->view('web.post-home', compact('items', 'category'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $post = $this->repository()->find($id);
        if (!$post) {
            abort(404, trans('post.the post has been deleted'));
        }

        $post->incrementViews();
        $tags = preg_split('/\s/', $post->tags);

        return $this->view('web.post-detail', compact('post', 'tags'));
    }
}
