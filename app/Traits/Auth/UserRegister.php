<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-20
 * Time: 20:03
 */

namespace App\Traits\Auth;


use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait UserRegister
{
    use RegistersUsers;

    protected function redirectTo()
    {
        return '/user';
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|username|unique:user',
            'mobile' => 'required|string|mobile|unique:user',
            'password' => 'required|string|pwd',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Model
     */
    protected function create(array $data)
    {
        $data['password'] = bcrypt($data['password'] ?? '');
        return User::create($data);
    }
}
