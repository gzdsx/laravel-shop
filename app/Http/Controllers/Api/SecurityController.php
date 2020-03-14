<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecurityController extends BaseController
{
    public function updatePassword(Request $request)
    {
        $password = $request->input('password');

        $this->user()->update([
            'password'=>Hash::make($password)
        ]);
    }
}
