<?php

namespace App\Http\Controllers\Api;

use App\Events\UserEvent;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    protected $userRepository;

    public function __construct(Request $request, UserRepositoryInterface $userRepository)
    {
        parent::__construct($request);
        $this->userRepository = $userRepository;
    }


    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'bail|required|string|account',
            'password' => 'bail|required|string|password',
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);
        $user = $this->guard()->user();
        event(new UserEvent($user, 'loggedin'));

        return ajaxReturn([
            'access_token' => $this->userRepository->getAccessToken($user),
            'userinfo' => $user->only(['uid', 'gid', 'username', 'email', 'mobile', 'avatar'])
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return ajaxError(422, trans('auth.failed'));
    }


    /**
     * @param Request $request
     * @return bool
     */
    public function attemptLogin(Request $request)
    {
        $account = $request->input('account');
        $password = $request->input('password');

        $emailLogin = $this->guard()->attempt([
            'email' => $account,
            'password' => $password
        ], $request->has('remember'));

        if ($emailLogin) {
            return true;
        }

        $mobileLogin = $this->guard()->attempt([
            'mobile' => $account,
            'password' => $password
        ], $request->has('remember'));

        if ($mobileLogin) {
            return true;
        }

        $usernameLogin = $this->guard()->attempt([
            'username' => $account,
            'password' => $password
        ], $request->has('remember'));

        if ($usernameLogin) {
            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loggedOut(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @return string
     */
    public function username()
    {
        return 'account';
    }
}
