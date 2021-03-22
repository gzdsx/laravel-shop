<?php

namespace App\Http\Controllers\Admin;


use App\Models\PostItem;
use App\Traits\Post\PostTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseController
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
    public function get(Request $request)
    {

        if (is_null($post = $this->repository()->find($request->input('aid')))) {
            $post = $this->repository()->make([
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
        $post->load(['user', 'content', 'images', 'media']);

        return $this->sendGetPostResponse($request, $post);
    }
}
