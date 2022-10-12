<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Controller;
use App\Models\EcomProductClassify;
use Illuminate\Http\Request;

class ProductClassifyController extends Controller
{
    use HasEcomShopSession;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|EcomProductClassify
     */
    protected function repository()
    {
        return $this->shop()->classifies();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $items = $this->shop()->classifies;
        return jsonSuccess([
            'items' => $items,
            'total' => $items->count()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $classify = $this->repository()->findOrNew($request->input('cate_id'));
        $classify->fill($request->input('classify', []))->save();

        if (!$classify->sort_num) {
            $classify->sort_num = $classify->cate_id;
            $classify->save();
        }

        return jsonSuccess(['classify' => $classify]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('cate_id'))->delete();
        return jsonSuccess();
    }
}
