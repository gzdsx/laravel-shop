<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-20
 * Time: 10:02
 */

namespace App\Traits\Item;


use App\Models\Item;
use Illuminate\Http\Request;

trait ItemManageTrait
{
    use ItemTrait;

    /**
     * @return Item|\Illuminate\Database\Eloquent\Builder
     */
    protected function query()
    {
        return Item::query()->withoutGlobalScopes(['available']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $attributes = collect($request->input('item',[]));
        if ($itemid = $request->input('itemid')) {
            $item = $this->query()->findOrNew($itemid);
        } else {
            $item = $this->query()->make();
        }
        $item->fill($attributes->except('itemid')->all())->save();

        if ($attributes->has('content')) {
            if (is_array($attributes->get('content'))) {
                $item->content->update($attributes->get('content'));
            } else {
                $item->content->update(['content' => $attributes->get('content')]);
            }
        }

        if ($attributes->has('cates')) {
            $item->cates()->delete();
            foreach ($attributes->get('cates') as $catid) {
                $item->cates()->updateOrCreate(['catid' => $catid]);
            }
        }

        if ($attributes->has('images')) {
            $this->updateImages($item, $attributes->get('images'));
        }

        if ($attributes->has('skus')) {
            $this->updateSkus($item, $attributes->get('skus'));
        }
        return $this->sendSavedItemResponse($request, $item);
    }

    /**
     * @param Item $item
     * @param array $images
     * @return mixed
     */
    protected function updateImages(&$item, $images)
    {
        $images = collect($images);
        if ($images->count()) {
            $firstImg = $images->first();
            $item->thumb = $firstImg['thumb'];
            $item->image = $firstImg['image'];
            $item->save();

            $displayorder = 0;
            $imageIds = $item->images->pluck('id', 'id');
            foreach ($images as $image) {
                $imgid = $image['id'];
                $image['displayorder'] = $displayorder++;
                if ($imageIds->has($imgid)) {
                    $image['thumb'] = strip_image_url($image['thumb'] ?? '');
                    $image['image'] = strip_image_url($image['image'] ?? '');
                    $item->images()->whereKey($imgid)->update($image);
                    $imageIds->forget($imgid);
                } else {
                    $item->images()->create($image);
                }
            }
            $item->images()->whereKey($imageIds)->delete();
        } else {
            $item->images()->delete();
        }
        return $item;
    }

    /**
     * @param Item $item
     * @param array $skus
     */
    protected function updateSkus($item, $skus)
    {
        $skus = collect($skus);
        $haveSkus = $item->skus()->get('properties')->pluck('properties', 'properties');
        foreach ($skus as $sku) {
            $properties = $sku['properties'] ?? '';
            if ($haveSkus->has($properties)) {
                $item->skus()->where('properties', $properties)->update($sku);
                $haveSkus->forget($properties);
            } else {
                $item->skus()->create($sku);
            }
        }

        foreach ($haveSkus as $properties) {
            $item->skus()->where('properties', $properties)->delete();
        }
    }


    /**
     * @param Request $request
     * @param Item|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model $item
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSavedItemResponse(Request $request, $item)
    {
        return ajaxReturn(['item' => $item]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        foreach ($this->query()->whereKey($request->input('items',[]))->get() as $item){
            $item->delete();
        }
        return $this->sendDeletedItemResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendDeletedItemResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $items = $request->input('items', []);
        $params = $request->input('params',[]);
        foreach ($this->query()->whereKey($items)->get() as $item){
            $item->fill($params)->save();
        }

        return $this->sendBatchUpdatedItemResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchUpdatedItemResponse(Request $request)
    {
        return ajaxReturn();
    }
}
