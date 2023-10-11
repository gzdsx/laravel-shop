<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
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
    public function getInfo(Request $request)
    {
        $link = $this->repository()->find($request->input('id'));
        return json_success($link);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        return json_success(['items' => $this->repository()->onlyLink()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $link = $this->repository()->findOrNew($request->input('id'));
        $link->fill($request->input('link', []))->save();
        return json_success($link);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->delete();
        return json_success();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoryList()
    {
        return json_success(['items' => $this->repository()->onlyCategory()->get()]);
    }
}
