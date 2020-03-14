<?php

namespace App\Http\Controllers\Home;


use App\Traits\Item\ItemTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    use ItemTrait;

    /**
     *
     */
    public function index(Request $request)
    {
        return $this->showItems($request);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\Paginator $items
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showItemsView(Request $request, $items)
    {
        return $this->view('mall.item.search', [
            'q' => $request->input('q'),
            'catid' => $request->input('catid'),
            'sort' => $request->input('sort', 'default'),
            'items' => $items,
            'totalCount' => $items->total(),
            'pagination' => $items->appends($request->except('page'))->render(),
            'hotSaleList' => $this->itemRepository()->filter(['sort' => 'sold-desc'])->fetch(0, 5)
        ]);
    }

    /**
     *
     */
    public function shop()
    {

    }
}
