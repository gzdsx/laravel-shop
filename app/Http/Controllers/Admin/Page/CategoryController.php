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
    public function getAll()
    {
        return jsonSuccess(['items' => $this->repository()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $category = $this->repository()->findOrNew($request->input('catid'));
        $category->fill($request->input('category', []))->save();

        return jsonSuccess(['category' => $category]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->get()->map(function ($category) {
            $category->delete();
        });

        return jsonSuccess();
    }
}
