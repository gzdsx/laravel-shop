<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-21
 * Time: 13:26
 */

namespace App\Services;


use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Validator;

class UserService implements UserServiceInterface
{
    protected $repository;

    public function __construct()
    {
        $this->repository = app(UserRepositoryInterface::class);
    }

    /**
     * @param $uid
     * @return \App\Models\User
     */
    public function findByUid($uid)
    {
        // TODO: Implement findByUid() method.
        return $this->repository->findOrFail($uid);
    }

    /**
     * @param array $filter
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate(array $filter = [], $perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
    {
        // TODO: Implement paginate() method.
        return $this->repository->with('group')->filter($filter)->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @param array $items
     * @return mixed
     */
    public function batchUpdate(array $items, array $values)
    {
        // TODO: Implement batchUpdate() method.
        return $this->repository->whereKey($items)->update($values);
    }

    /**
     * @param array $items
     * @return mixed
     */
    public function batchDelete(array $items)
    {
        // TODO: Implement batchDelete() method.
        return $this->repository->whereKey($items)->delete();
    }

    /**
     * @param $uid
     * @param array $attributes
     * @return mixed
     */
    public function update($uid, array $attributes)
    {
        // TODO: Implement update() method.
        $user = $this->findByUid($uid);
        $validate = $this->validator($attributes);
        if ($message = $validate->getMessageBag()->first()) {
            abort(400, $message);
        }
        $user->fill($attributes)->save();
        return $user;
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function delete($uid)
    {
        // TODO: Implement delete() method.
        return $this->repository->destroy($uid);
    }

    /**
     * @param array $attributes
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes)
    {
        // TODO: Implement create() method.
        $validate = $this->validator($attributes);
        if ($message = $validate->getMessageBag()->first()) {
            abort(400, $message);
        }

        return $this->repository->create($attributes);
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    public function validator(array $attributes)
    {
        // TODO: Implement validator() method.
        $rules = [];
        if (isset($attributes['username'])) {
            $rules['username'] = 'required|string|username|unique:user';
        }

        if (isset($attributes['password']) && !empty($attributes['password'])) {
            $rules['password'] = 'required|string|password|confirmed';
        }

        if (isset($attributes['mobile'])) {
            $rules['mobile'] = 'required|string|mobile|unique:user';
        }

        if (isset($attributes['email'])) {
            $rules['email'] = 'required|string|email|unique:user';
        }

        return Validator::make($attributes, $rules);
    }

    /**
     * @param User $user
     * @return mixed|string
     */
    public function getAccessToken($user)
    {
        return $user->createToken(\Laravel\Passport\Client::find(1)->name)->accessToken;
    }
}
