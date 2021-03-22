<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    /**
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    public function repository()
    {
        return User::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $user = $this->repository()->with('group')->find($request->input('uid'));
        return jsonSuccess(['user' => $user->makeVisible(['admincp'])]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {

        $query = $this->repository()->filter($request->all())->with('group');
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))->limit(15)->get()
        ]);
    }

    public function save(Request $request)
    {
        $user = $this->repository()->findOrNew($request->input('uid'));
        $attributes = collect($request->input('user', []));

        $username = $attributes->get('username');
        if ($user->username != $username) {
            if ($this->repository()->where('username', $username)->exists()) {
                return jsonError(422, trans('user.username has been taken'));
            } else {
                $user->username = $username;
            }
        }

        $password = $attributes->get('password');
        if ($password) $user->password = Hash::make($password);

        $mobile = $attributes->get('mobile');
        if ($mobile) {
            if ($user->mobile != $mobile) {
                if ($this->repository()->where('mobile', $mobile)->exists()) {
                    return jsonError(422, trans('user.mobile has been taken'));
                } else {
                    $user->mobile = $mobile;
                }
            }
        }

        $email = $attributes->get('email');
        if ($email) {
            if ($user->email != $email) {
                if ($this->repository()->where('email', $email)->exists()) {
                    return jsonError(422, trans('user.email has been taken'));
                } else {
                    $user->email = $email;
                }
            }
        }

        $user->gid = $attributes->get('gid', 6);
        $user->admincp = $attributes->get('admincp', 0);
        $user->save();

        if (!$request->input('uid')) {
            event(new Registered($user));
        }

        return jsonSuccess(['user' => $user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->get()->map(function (User $user) {
            if ($user->uid != 1000000) $user->delete();
        });
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->get()->map(function ($user) use ($request) {
            if ($user->uid != 1000000) {
                $user->update($request->input('data', []));
            }
        });
        return jsonSuccess();
    }
}
