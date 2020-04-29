<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    /**
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return User::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return ajaxReturn(['user' => $this->query()->with('group')->find($request->input('uid'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {

        $query = $this->query()->filter($request->all())->with('group');
        return ajaxReturn([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))->limit(15)->get()
        ]);
    }

    public function update(Request $request)
    {
        $user = User::findOrNew($request->input('uid'));
        $attributes = collect($request->input('user', []));

        $username = $attributes->get('username');
        if ($user->username != $username) {
            if (User::where('username', $username)->exists()) {
                return ajaxError(422, __('user.username has been taken'));
            } else {
                $user->username = $username;
            }
        }

        $password = $attributes->get('password');
        if ($password) {
            $user->password = Hash::make($password);
        }

        $mobile = $attributes->get('mobile');
        if ($mobile) {
            if ($user->mobile != $mobile) {
                if (User::where('mobile', $mobile)->exists()) {
                    return ajaxError(422, __('user.mobile has been taken'));
                } else {
                    $user->mobile = $mobile;
                }
            }
        }

        $email = $attributes->get('email');
        if ($email) {
            if ($user->email != $email) {
                if (User::where('email', $email)->exists()) {
                    return ajaxError(422, __('user.email has been taken'));
                } else {
                    $user->email = $email;
                }
            }
        }

        $user->gid = $attributes->get('gid', 6);
        $user->admincp = $attributes->get('admincp', 0);
        $user->save();

        return ajaxReturn(['user' => $user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->query()->whereKey($request->input('items', []))->get()->map(function (User $user) {
            if ($user->uid != 1000000) $user->delete();
        });
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $this->query()->whereKey($request->input('items', []))->get()->map(function ($user) use ($request) {
            if ($user->uid != 1000000) {
                $user->update($request->input('params', []));
            }
        });
        return ajaxReturn();
    }
}
