<?php

namespace App\Http\Controllers\User;

use App\Traits\Mall\ItemCollectTrait;
use Illuminate\Http\Request;

class ItemCollectController extends BaseController
{
    use ItemCollectTrait;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->assign(['menu'=>'collect']);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\Paginator $items
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showCollectedItemsView(Request $request, $items)
    {
        return $this->view('user.collect.item',[
            'q'=>$request->input('q'),
            'items'=>$items,
            'pagination'=>$items->appends($request->except('page'))->render()
        ]);
    }
}
