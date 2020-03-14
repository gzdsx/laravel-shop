<?php

namespace App\Http\Controllers\Admin;


use App\Models\FreightTemplate;
use App\Models\ItemReviews;
use App\Traits\Item\ItemManagerTrait;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    use ItemManagerTrait;

    /**
     * 商品列表
     * @throws \Exception
     */
    public function index(Request $request)
    {
        return $this->showItems($request);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Pagination\Paginator $items
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showItemsView(Request $request, $items)
    {
        $this->assign(array_merge([
            'shop_name' => '',
            'seller_name' => '',
            'sale_state' => '',
            'title' => '',
            'min_price' => '',
            'max_price' => '',
            'itemid' => '',
            'catid' => ''
        ], $request->all()));
        return $this->view('admin.item.items', [
            'items' => $items,
            'pagination' => $items->appends($request->except('page'))->render(),
            'catlogOptions' => $this->catlogRepository()->fetchOptions(0, $request->input('catid', 0))
        ]);
    }

    /**
     * @param Request $request
     * @param $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPublishView(Request $request, $item)
    {
        $freightTemplates = FreightTemplate::all();
        $catlogOptions = $this->catlogRepository()->fetchOptions(0, $item->catid);
        return $this->view('admin.item.publish', compact('item', 'catlogOptions', 'freightTemplates'));
    }

    /**
     * @param Request $request
     * @param $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sendSavedResponse(Request $request, $item)
    {
        return $this->messager()->setLinks([
            [trans('common.reedit'), back()->getTargetUrl()],
            [trans('common.continue publish'), admin_url('item/edit?catid=' . $item->catid)],
            [trans('common.back list'), admin_url('item')],
            //[trans('common.preview'), post_url($item->itemid), '_blank']
        ])->render();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleBest(Request $request)
    {
        $items = $request->input('items', []);
        $is_best = $request->input('is_best', 0);
        $this->itemRepository()->whereKey($items)->update(['is_best' => $is_best]);
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reviews(Request $request)
    {
        $items = ItemReviews::with(['item', 'user'])->orderByDesc('id')->paginate(20);
        return $this->view('admin.item.reviews', [
            'items' => $items,
            'pagination' => $items->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delReviews(Request $request)
    {
        $delete = $request->input('delete', []);
        ItemReviews::whereIn('id', $delete)->delete();

        return ajaxReturn();
    }
}
