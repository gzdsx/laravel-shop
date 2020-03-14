<?php

namespace App\Http\Controllers\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CollectController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->assign(['menu'=>'collect']);
    }

    /**
     * @param string $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){

        return $this->item($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function item(Request $request){
        $q = $request->input('q');
        $items = $this->user()->collectedItems()->with('item')->when($q, function (Builder $builder) use ($q){
            return $builder->where('title', 'LIKE', "%$q%");
        })->orderByDesc('id')->paginate(10);
        return $this->view('user.collect.item', [
            'q'=>$q,
            'items'=>$items,
            'pagination'=>$items->appends($q ? ['q'=>$q] : [])->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shop(Request $request){
        $q = $request->input('q');
        $items = $this->user()->subscribedShops()->with('shop')->when($q, function (Builder $builder) use ($q){
            return $builder->whereHas('shop', function (Builder $builder) use ($q){
                return $builder->where('shop_name', 'LIKE',"%$q%");
            });
        })->orderByDesc('id')->paginate(10);

        return $this->view('user.collect.shop',[
            'q'=>$q,
            'items'=>$items,
            'pagination'=>$items->appends($q ? ['q'=>$q] : [])->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function post(Request $request){
        $q = $request->input('q');
        $items = $this->user()->collectedPosts()->with('post')->when($q, function (Builder $builder) use ($q){
            return $builder->whereHas('post', function (Builder $builder) use ($q){
                return $builder->where('title', 'LIKE',"%$q%");
            });
        })->orderByDesc('id')->paginate(10);

        return $this->view('user.collect.post',[
            'q'=>$q,
            'items'=>$items,
            'pagination'=>$items->appends($q ? ['q'=>$q] : [])->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteItem(Request $request){
        $id = $request->input('id', 0);
        $this->user()->collectedItems()->where('id', $id)->delete();
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteShop(Request $request){
        $id = $request->input('id', 0);
        $this->user()->subscribedShops()->where('id', $id)->delete();
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePost(Request $request){
        $id = $request->input('id', 0);
        $this->user()->collectedPosts()->where('id', $id)->delete();
        return ajaxReturn();
    }
}
