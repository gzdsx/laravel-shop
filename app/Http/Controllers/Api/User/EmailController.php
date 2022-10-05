<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function bind(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required|string|email'
        ]);

        $user = Auth::user();
        $email = $request->input('email');
        if ($user->email != $email) {
            if (User::query()->where('email', $email)->exists()) {
                abort(422, trans('user.email has been taken'));
            }
        }
        $user->email = $email;
        $user->save();

        return jsonSuccess();
    }
}
