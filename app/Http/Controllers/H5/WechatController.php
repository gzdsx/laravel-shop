<?php

namespace App\Http\Controllers\H5;


use App\Models\EcomProductItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WechatController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        return redirect()->to('/h5/user/fill');
    }
}
