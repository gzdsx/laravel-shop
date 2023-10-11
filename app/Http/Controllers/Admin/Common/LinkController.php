<?php

namespace App\Http\Controllers\Admin\Common;


use App\Http\Controllers\Admin\BaseController;
use App\Models\CommonLink;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * @return CommonLink|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonLink::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function link(Request $request)
    {
        $model = $this->repository()->find($request->input('id'));
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function links(Request $request)
    {
        $query = $this->repository()->onlyLink();
        if ($cate_id = $request->input('cate_id')) {
            $query->where('cate_id', $cate_id);
        }
        return json_success([
            'total' => $query->count(),
            'items' => $query->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories(Request $request)
    {
        return json_success(['items' => $this->repository()->onlyCategory()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newLink = $request->input('link', []);
        $model = $this->repository()->findOrNew($newLink['id'] ?? 0);
        $model->fill($newLink)->save();
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->each->delete();
        return json_success();
    }
}
