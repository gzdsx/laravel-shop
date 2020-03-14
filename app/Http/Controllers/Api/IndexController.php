<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\Shop;
use App\Repositories\Contracts\ItemRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{

    public function test()
    {
        abort(422, '11222211');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function tuijian(Request $request)
    {

        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);

        $items = DB::table('item_push AS p')
            ->leftJoin('item AS i', 'i.itemid', '=', 'p.itemid')
            ->where(['i.on_sale' => 1])->orderByDesc('p.id')->offset($offset)->limit($count)
            ->groupBy('i.itemid')->get(['i.*'])->map(function ($item) {
                if ($item->sold > 10000) {
                    $item->sold = round($item->sold / 10000, 1) . '万';
                }
                $item->thumb = image_url($item->thumb);
                $item->image = image_url($item->image);
                return $item;
            });

        return ajaxReturn(['items' => $items]);
    }

    /**
     * 营养餐配送企业
     * @return \Illuminate\Http\JsonResponse
     */
    public function food()
    {
        $shopIds = [1838, 1633, 1841];
        $shops = [];
        Shop::whereIn('shop_id', $shopIds)->get()->map(function ($shop) use (&$shops) {
            $shop->logo = image_url($shop->logo);
            $shop->items = [];
            $shops[$shop->shop_id] = $shop->toArray();
        });

        $prefix = DB::getTablePrefix();
        $query = DB::table(DB::raw($prefix . "item as i"))
            ->where(DB::raw("(select count(*) from {$prefix}item where shop_id=i.shop_id and itemid<i.itemid)"), '<', 3);

        //echo $query->toSql();exit();
        $query->whereIn('shop_id', $shopIds)->orderByDesc('itemid')->get()->map(function ($item) use (&$shops) {
            $item->thumb = image_url($item->thumb);
            $item->image = image_url($item->image);
            $shops[$item->shop_id]['items'][] = $item;
        });

        return ajaxReturn(['shops' => array_values($shops)]);
    }

    public function getFoods(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 0);
        $items = Item::whereIn('shop_id', [1844])
            ->whereNotNull('thumb')
            ->offset($offset)->limit($count)->orderByDesc('itemid')
            ->get()->map(function ($item) {
                $item->thumb = image_url($item->thumb);
                $item->image = image_url($item->image);
                return $item;
            });

        return ajaxReturn(['items' => $items]);
    }

    /**
     * 粗耕优选
     * @return \Illuminate\Http\JsonResponse
     */
    public function youxuan(Request $request)
    {
        $offset = intval($request->input('offset'));
        $count = intval($request->input('count'));
        !$count && $count = 20;

        $items = DB::table('item_push AS p')
            ->leftJoin('item AS i', 'i.itemid', '=', 'p.itemid')
            ->where(['p.groupid' => 3, 'i.on_sale' => 1])->orderByDesc('p.id')->offset($offset)->limit($count)
            ->groupBy('i.itemid')->get(['i.*'])->map(function ($item) {
                if ($item->sold > 10000) {
                    $item->sold = round($item->sold / 10000, 1) . '万';
                }
                $item->thumb = image_url($item->thumb);
                $item->image = image_url($item->image);
                return $item;
            });

        return ajaxReturn(['items' => $items]);
    }

    /**
     * 精准扶贫
     * @return \Illuminate\Http\JsonResponse
     */
    public function fupin(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 20);

        $items = app(ItemRepositoryInterface::class)->where('shop_id', 1812)->offset($offset)->limit($count)->get();

        return ajaxReturn(['items' => $items]);
    }

    public function nutritious()
    {
        $shops = Shop::whereHas('items', null, '>', 2)->whereIn('shop_id', [1838, 1633, 1841, 1844])->get();

        $prefix = DB::getTablePrefix();
        $itemRes = Item::from('item as i')
            ->whereIn('shop_id', $shops->pluck('shop_id'))
            ->where(DB::raw("(select count(*) from {$prefix}item where shop_id={$prefix}i.shop_id and itemid<{$prefix}i.itemid)"), '<', 3)
            ->get();

        $items = [];
        foreach ($itemRes as $item) {
            $items[$item->shop_id][] = $item;
        }

        $shops->each(function (Shop $shop) use ($items) {
            if (isset($items[$shop->shop_id])) {
                $shop->setAttribute('items', $items[$shop->shop_id]);
            } else {
                $shop->setAttribute('items', []);
            }
        });

        return ajaxReturn(['shops' => $shops]);
    }

    public function techan(Request $request)
    {

    }
}
