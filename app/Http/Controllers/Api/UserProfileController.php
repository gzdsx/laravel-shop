<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        return jsonSuccess(['profile' => Auth::user()->profile]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $profile = Auth::user()->profile->fill($request->input('profile', []))->save();
        return jsonSuccess(['profile' => $profile]);
    }
}
