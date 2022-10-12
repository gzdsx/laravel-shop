<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use App\Models\EcomProductAttr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductAttrController extends BaseController
{
    use HasEcomShopSession;

    /**
     * @return EcomProductAttr|Builder
     */
    protected function repository()
    {
        $shop = $this->shop();
        return EcomProductAttr::withGlobalScope('owner', function (Builder $builder) use ($shop) {
            return $builder->where('shop_id', $shop->shop_id);
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $attr = $this->repository()->findOrFail($request->input('attr_cate_id'));
        return jsonSuccess(['attr' => $attr]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $items = $this->repository()->get();
        return jsonSuccess([
            'total' => $items->count(),
            'items' => $items
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $attr = $this->repository()->make($request->input('attr', []));
        $attr->shop()->associate($this->shop());
        $attr->save();

        return jsonSuccess(['attr' => $attr]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $attr = $this->repository()->findOrFail($request->input('attr_cate_id'));
        $attr->fill($request->input('attr', []))->save();

        return jsonSuccess(['attr' => $attr]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $attr = $this->repository()->findOrFail($request->input('attr_cate_id'));
        $attr->delete();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAttrValue(Request $request)
    {
        $attr_title = $request->input('attr_title');
        $attr_value = $request->input('attr_value');

        $attr = $this->repository()->firstOrCreate(['attr_title' => $attr_title]);
        $value = $attr->attrValues()->firstOrCreate(['attr_value' => $attr_value]);

        return jsonSuccess(['attr_value' => $value]);
    }
}
