<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Models\RegionalAgent;
use App\Models\User;
use Illuminate\Http\Request;

class RegionalAgentController extends BaseController
{
    /**
     * @return RegionalAgent|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return RegionalAgent::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        return jsonSuccess(['agent' => $this->repository()->find($request->input('id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $query = $this->repository();
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->with('user')->offset($request->input('offset', 0))
                ->take($request->input('count', 10))->orderByDesc('id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $newAgent = $request->input('agent', []);
        if (!$user = User::find($newAgent['uid'])) {
            abort(404, '账号ID:' . $newAgent['uid'] . ' 不存在');
        }
        $agent = $this->repository()->make($newAgent);
        $agent->save();

        return jsonSuccess(['agent' => $agent]);
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
