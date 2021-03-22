<?php

namespace App\Http\Controllers\Admin;


use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * @return Link|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Link::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['link' => $this->repository()->find($request->input('id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        if ($request->input('type') == 'category') {
            return jsonSuccess(['items' => $this->repository()->onlyCategory()->get()]);
        }
        return jsonSuccess(['items' => $this->repository()->onlyLink()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $link = $this->repository()->findOrNew($request->input('id'));
        $link->fill($request->input('link', []))->save();
        return jsonSuccess(['link' => $link]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->delete();
        return jsonSuccess();
    }
}
