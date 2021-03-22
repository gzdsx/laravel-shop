<?php

namespace App\Http\Controllers\Api;

use App\Events\UserEvent;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{

    use RegistersUsers;

    /**
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return User::query();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'username' => 'bail|required|string|username|unique:user',
            'mobile' => 'bail|required|string|mobile|unique:user',
            'password' => 'bail|required|string|pwd'
        ]);
        if ($message = $validator->getMessageBag()->first()) {
            abort(422, $message);
        }
        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    protected function create(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->repository()->create($data);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function registered(Request $request, User $user)
    {
        event(new UserEvent($user, 'registered'));
        $userinfo = array_merge(
            $user->only('uid', 'username', 'mobile', 'email', 'avatar'),
            $user->info->only(['gender', 'province', 'city', 'district'])
        );
        $access_token = $user->createToken($user->uid)->accessToken;
        return jsonSuccess([
            'access_token' => $access_token,
            'userinfo' => $userinfo
        ]);
    }
}
