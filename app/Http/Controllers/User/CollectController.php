<?php

namespace App\Http\Controllers\User;

use App\Models\ProductCollect;
use App\Models\PostCollect;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchgetPosts(Request $request)
    {
        $q = $request->input('q');
        $query = PostCollect::where('uid', Auth::id())->with('post');
        if ($q){
            $query->whereHas('post', function (Builder $builder) use ($q) {
                return $builder->where('title', 'like', "%$q%");
            });
        }

        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))
                ->orderByDesc('id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePost(Request $request)
    {
        PostCollect::where(['uid' => Auth::id(), 'id' => $request->input('id')])->delete();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchgetItems(Request $request)
    {
        $q = $request->input('q');
        $query = ProductCollect::where('uid', Auth::id())->with('item');
        if ($q){
            $query->whereHas('item', function (Builder $builder) use ($q) {
                return $builder->where('title', 'like', "%$q%");
            });
        }

        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))
                ->orderByDesc('id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteItem(Request $request)
    {
        ProductCollect::where(['uid' => Auth::id(), 'id' => $request->input('id')])->delete();
        return jsonSuccess();
    }
}
