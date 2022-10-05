<?php

namespace App\Http\Controllers\Admin\Post;


use App\Http\Controllers\Admin\BaseController;
use App\Models\PostItem;
use App\Traits\Post\PostItemTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends BaseController
{
    use PostItemTrait;

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
    public function getInfo(Request $request)
    {

        if (is_null($model = $this->repository()->find($request->input('aid')))) {
            $model = $this->repository()->make([
                'uid' => Auth::id(),
                'price' => '0',
                'from' => env('APP_NAME'),
                'fromurl' => env('APP_URL'),
                'summary' => '',
                'type' => 'article',
                'state' => '1',
                'author' => Auth::user()->username,
                'created_at' => now(),
                'allowcomment' => 1
            ]);
        }
        $model->load(['user', 'content', 'images', 'media']);

        return jsonSuccess($model);
    }
}
