<?php

namespace App\Http\Controllers\Api;

use App\Models\ItemPush;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ItemPushController extends BaseController
{
    public function batchgetItem(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);

        $groupid = $request->input('groupid');
        $key = 'ItemPush_' . $groupid . '_' . $offset . '_' . $count;
        $items = Cache::remember($key, 5, function () use ($groupid, $offset, $count) {
            $items = ItemPush::with('item')->whereHas('item', function ($query) {
                return $query->onSale();
            })->where('groupid', $groupid)->offset($offset)->limit($count)
                ->orderByDesc('id')->get()->map(function ($item) {
                    $item->item->thumb = image_url($item->item->thumb);
                    $item->item->image = image_url($item->item->image);
                    return $item->item;
                });
            return $items;
        });

        return ajaxReturn(['items' => $items]);
    }
}
