<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends BaseController
{
    /**
     * @return Label|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Label::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['label' => $this->repository()->find($request->input('id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        return jsonSuccess([
            'total' => $this->repository()->count(),
            'items' => $this->repository()->offset($request->input('offset', 0))
                ->limit($request->input('count', 20))
                ->orderByDesc('id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->delete();
        Label::updateCache();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $label = $this->repository()->findOrNew($request->input('id'));
        $label->fill($request->input('label', []))->save();
        Label::updateCache();
        return jsonSuccess(['label' => $label]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        foreach ($this->repository()->whereKey($request->input('items', []))->get() as $label) {
            $label->fill($request->input('data', []))->save();
        }
        return jsonSuccess();
    }
}
