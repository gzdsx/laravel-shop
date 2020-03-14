<?php

namespace App\Http\Controllers\Api;

use App\Events\UserEvent;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $userRepository;

    public function __construct(Request $request, UserRepositoryInterface $userRepository)
    {
        parent::__construct($request);
        $this->userRepository = $userRepository;
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
            'password' => 'bail|required|string|password|unique:user'
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
        return $this->userRepository->create($data);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function registered(Request $request, User $user)
    {
        event(new UserEvent($user, 'register'));
        return ajaxReturn([
            'access_token' => $this->userRepository->getAccessToken($user),
            'userinfo' => $user->only(['uid', 'gid', 'username', 'email', 'mobile', 'avatar'])
        ]);
    }
}
