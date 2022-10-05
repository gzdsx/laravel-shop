<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNameController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $username = $request->input('username');
        if (User::where('uid', '<>', Auth::id())->where('username', $username)->exists()) {
            abort(500, trans('user.username has been taken'));
        }

        $user = Auth::user();
        $user->username = $username;
        $user->save();

        return jsonSuccess(['username' => $username]);
    }
}
