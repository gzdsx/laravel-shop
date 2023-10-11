<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CommonLabel;
use Illuminate\Http\Request;

class LabelController extends BaseController
{
    /**
     * @return CommonLabel|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonLabel::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function label(Request $request)
    {
        $model = $this->repository()->find($request->input('id'));
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function labels(Request $request)
    {
        return json_success([
            'total' => $this->repository()->count(),
            'items' => $this->repository()->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))->orderByDesc('id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->delete();
        CommonLabel::updateCache();
        return json_success();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $newLabel = $request->input('label', []);
        $model = $this->repository()->findOrNew($newLabel['id'] ?? 0);
        $model->fill($newLabel)->save();
        CommonLabel::updateCache();
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->update($request->input('data', []));
        CommonLabel::updateCache();
        return json_success();
    }
}
