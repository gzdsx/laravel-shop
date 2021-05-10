<?php

namespace App\Http\Controllers\Admin\Foundation;


use App\Http\Controllers\Admin\BaseController;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends BaseController
{
    /**
     * @return Ad|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Ad::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['ad' => $this->repository()->findOrNew($request->input('id'))]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function batchget(Request $request)
    {
        return ['items' => $this->repository()->get()];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $ad = $this->repository()->findOrNew($request->input('id'));
        $ad->fill($request->input('ad', []))->save();
        return jsonSuccess(['ad' => $ad]);
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->update($request->input('data', []));
        return jsonSuccess();
    }
}
