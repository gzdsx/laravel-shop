<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Models\EcomShop;
use App\Traits\Ecom\ShopTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends BaseController
{
    use ShopTrait;

    /**
     * @return EcomShop|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return EcomShop::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository()->filter($request->all());

        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->with('certify')
                ->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->each->delete();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
        $shop = $this->repository()->find($request->input('shop_id'));
        $shop->auth_state = $request->input('auth_state', 0);
        $shop->save();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->update($request->input('data', []));
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('shop_id'));
        $model->fill($request->input('shop', []));

        if (!$model->seller_id) {
            $model->seller()->associate(Auth::id());
        }

        $model->save();

        if ($request->has('images')) {
            $images = $request->input('images', []);
            $model->images()->whereNotIn('id', collect($images)->pluck('id'))->delete();

            foreach ($images as $k => $v) {
                $v['sort_num'] = $k;
                $model->images()->updateOrCreate(['id' => $v['id'] ?? 0], $v);
            }
        }

        return jsonSuccess();
    }
}
