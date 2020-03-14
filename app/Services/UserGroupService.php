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
 * Time: 00:25
 */

namespace App\Services;


use App\Repositories\Contracts\UserGroupRepositoryInterface;
use App\Services\Contracts\UserGroupServiceInterface;

class UserGroupService implements UserGroupServiceInterface
{
    protected $repository;

    public function __construct()
    {
        $this->repository = app(UserGroupRepositoryInterface::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUserGroups()
    {
        // TODO: Implement getUserGroups() method.
        return $this->repository->where('type', 'user')->orderBy('creditslower')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getSystemGroups()
    {
        // TODO: Implement getSystemGroups() method.
        return $this->repository->where('type', 'system')->orderBy('gid')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        // TODO: Implement all() method.
        return $this->repository->all();
    }
}
