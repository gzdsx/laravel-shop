<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperiorController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        return jsonSuccess(['superior' => Auth::user()->parent()->firstOrFail()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bind(Request $request)
    {
        $username = $request->input('username');
        $phone = $request->input('phone');

        $user = Auth::user();
        if ($user->parent) {
            //abort(500, '您已绑定过联系人，不能重复绑定');
        }

        if ($superior = User::where(compact('username', 'phone'))->first()) {
            $user->parent()->associate($superior);
            $user->save();
            return jsonSuccess();
        }

        return jsonError(500, '您填写的联系人不存在');
    }
}
