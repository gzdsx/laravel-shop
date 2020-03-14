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


use App\Models\Account;

interface AccountServiceInterface
{
    public function incrementBalance(Account $account, $amount);

    public function decrementBalance(Account $account, $amount);

    public function incrementFreeze(Account $account, $amount);

    public function decrementFreeze(Account $account, $amount);

    public function freeze(Account $account, $amount);

    public function unFreeze(Account $account, $amount);
}
