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
 * Time: 00:35
 */

namespace App\Services\Contracts;


interface UserServiceInterface
{
    /**
     * @param $uid
     * @return \App\Models\User
     */
    public function findByUid($uid);

    public function paginate(array $filter = [], $perPage = 15, $columns = ['*'], $pageName = 'page', $page = null);

    public function batchUpdate(array $items, array $values);

    public function batchDelete(array $items);

    public function update($uid, array $attributes);

    public function delete($uid);

    /**
     * @param array $attributes
     * @return \App\Models\User
     */
    public function create(array $attributes);

    /**
     * @param array $attributes
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $attributes);

    /**
     * @param \App\Models\User $user
     * @return mixed
     */
    public function getAccessToken($user);
}
