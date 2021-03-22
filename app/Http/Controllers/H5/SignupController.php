<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verify;
use App\Traits\Auth\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SignupController extends BaseController
{
    use UserRegister;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        return $this->view('h5.auth.signup');
    }

    /**
     * @return string
     */
    protected function redirectTo()
    {
        return '/h5/user';
    }

    /**
     * @param Request $request
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function registered(Request $request, $user)
    {
        return jsonSuccess(['user' => $user]);
    }
}
