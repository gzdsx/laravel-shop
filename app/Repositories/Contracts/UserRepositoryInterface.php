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
 * Time: 13:24
 */

namespace App\Repositories\Contracts;


interface UserRepositoryInterface extends RepositoryInterface
{

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\App\Models\User
     */
    public function query();
    /**
     * @param \App\Models\User $user
     * @return mixed
     */
    public function getAccessToken($user);
}
