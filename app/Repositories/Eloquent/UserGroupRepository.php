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
 * Time: 00:18
 */

namespace App\Repositories\Eloquent;


use App\Models\UserGroup;
use App\Repositories\Contracts\UserGroupRepositoryInterface;

class UserGroupRepository extends BaseRepository implements UserGroupRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|string
     */
    public function model()
    {
        // TODO: Implement getModel() method.
        return UserGroup::class;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUserGroups()
    {
        // TODO: Implement getUserGroups() method.
        return $this->where('type', 'user')->orderBy('creditslower')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getSystemGroups()
    {
        // TODO: Implement getSystemGroups() method.
        return $this->where('type', 'system')->orderBy('gid')->get();
    }
}
