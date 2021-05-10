<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-22
 * Time: 21:37
 */

namespace App\Services\Contracts;


use App\Models\UserAccount;

interface AccountServiceInterface
{
    public function incrementBalance(UserAccount $account, $amount);

    public function decrementBalance(UserAccount $account, $amount);

    public function incrementFreeze(UserAccount $account, $amount);

    public function decrementFreeze(UserAccount $account, $amount);

    public function freeze(UserAccount $account, $amount);

    public function unFreeze(UserAccount $account, $amount);
}
