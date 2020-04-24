<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    /**
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return User::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return ajaxReturn(['user' => $this->query()->with('group')->find($request->input('uid'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {

        $query = $this->query()->filter($request->all())->with('group');
        return ajaxReturn([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))->limit(15)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->query()->whereKey($request->input('items', []))->get()->map(function (User $user) {
            if ($user->uid != 1000000) $user->delete();
        });
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $this->query()->whereKey($request->input('items', []))->get()->map(function ($user) use ($request) {
            if ($user->uid != 1000000) {
                $user->update($request->input('params', []));
            }
        });
        return ajaxReturn();
    }
}
