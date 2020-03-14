<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\Shop;
use App\Traits\Mall\ShopTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends BaseController
{
    use ShopTrait;

    public function batchget(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);

        $lng = $lat = 0;
        $location = $request->input('location');
        if ($location) {
            $point = explode(',', $location);
            $lng = floatval($point[0]);
            $lat = floatval($point[1]);
        } else {
            $lat = floatval($request->input('lat'));
            $lng = floatval($request->input('lng'));
        }

        $shops = Shop::whereHas('items', null, '>', 2)
            ->offset($offset)->limit($count)->orderByDesc('total_sold')->get();

        $prefix = DB::getTablePrefix();
        $itemRes = Item::from('item as i')
            ->whereIn('shop_id', $shops->pluck('shop_id'))
            ->where(DB::raw("(select count(*) from {$prefix}item where shop_id={$prefix}i.shop_id and itemid<{$prefix}i.itemid)"), '<', 3)
            ->get();

        $items = [];
        foreach ($itemRes as $item) {
            $items[$item->shop_id][] = $item;
        }

        $shops->each(function (Shop $shop) use ($items, $lng, $lat) {
            if (isset($items[$shop->shop_id])) {
                $shop->setAttribute('items', $items[$shop->shop_id]);
            } else {
                $shop->setAttribute('items', []);
            }

            $distance = 0;
            if ($shop->lng && $shop->lat) {
                $distance = distance(getDistance($lat, $lng, $shop->lat, $shop->lng));
            }
            $shop->setAttribute('distance', $distance);

            if ($shop->total_sold > 10000) {
                $shop->total_sold = round($shop->total_sold / 10000, 2) . '万';
            }
        });

        return ajaxReturn(['items' => $shops]);
    }
}
