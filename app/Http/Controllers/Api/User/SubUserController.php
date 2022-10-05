<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubUserController extends BaseController
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|User
     */
    protected function repository()
    {
        return Auth::user()->subUsers();
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
            'items' => $query->with(['member'])
                ->offset($request->input('offset', 0))
                ->take($request->input('count', 10))
                ->orderByDesc('uid')->get()
        ]);
    }
}
