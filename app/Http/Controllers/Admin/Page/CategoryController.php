<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Admin\BaseController;
use App\Models\PageCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return PageCategory::query();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        return jsonSuccess(['items' => $this->repository()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('cate_id'));
        $model->fill($request->input('category', []))->save();

        return jsonSuccess($model);
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
