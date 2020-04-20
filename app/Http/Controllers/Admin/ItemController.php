<?php

namespace App\Http\Controllers\Admin;


use App\Models\FreightTemplate;
use App\Models\ItemReviews;
use App\Traits\Item\ItemTrait;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    use ItemTrait;

    /**
     * 商品列表
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $freightTemplates = FreightTemplate::all();
        $catlogs = $this->catlogRepository()->fetchAll(0);
        return $this->view('admin.item',compact('catlogs','freightTemplates'));
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
