<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\PostItem;
use App\Traits\Post\PostTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use PostTrait;

    /**
     * @return PostItem|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return PostItem::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function post(Request $request)
    {
        if (is_null($model = $this->repository()->find($request->input('id')))) {
            $model = $this->repository()->make([
                'price' => '0',
                'from' => env('APP_NAME'),
                'fromurl' => env('APP_URL'),
                'excerpt' => '',
                'format' => 'article',
                'status' => 'draft',
                'author' => Auth::user()->nickname,
                'created_at' => now(),
                'allow_comment' => 1
            ]);
        }
        $model->load(['user', 'content', 'images', 'media', 'categories', 'metas']);

        return json_success($model);
    }
}
