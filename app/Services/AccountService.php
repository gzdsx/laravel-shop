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
 * Time: 21:39
 */

namespace App\Services;


use App\Models\UserAccount;
use App\Services\Contracts\AccountServiceInterface;

class AccountService implements AccountServiceInterface
{
    /**
     * @param UserAccount $account
     * @param $amount
     */
    public function incrementBalance(UserAccount $account, $amount)
    {
        // TODO: Implement incrementBalance() method.
        if ($amount > 0) {
            $account->balance = bcadd($account->balance, $amount, 2);
            $account->total_income = bcadd($account->balance, $amount, 2);
            $account->save();
        }
    }

    /**
     * @param UserAccount $account
     * @param $amount
     */
    public function decrementBalance(UserAccount $account, $amount)
    {
        // TODO: Implement decrementBalance() method.
        $amount = floatval($amount);
        if ($amount > $account->balance) {
            abort(400, trans('account.insufficient account balance'));
        }

        $account->balance = bcsub($account->balance, $amount, 2);
        $account->total_cost = bcadd($account->balance, $amount, 2);
        $account->save();
    }

    /**
     * @param UserAccount $account
     * @param $amount
     */
    public function incrementFreeze(UserAccount $account, $amount)
    {
        // TODO: Implement incrementFreeze() method.
        if ($amount) $account->increment('freeze', floatval($amount));
    }

    /**
     * @param UserAccount $account
     * @param $amount
     */
    public function decrementFreeze(UserAccount $account, $amount)
    {
        // TODO: Implement decrementFreeze() method.
        $amount = floatval($amount);
        if ($amount > $account->freeze) {
            abort(400, trans('account.insufficient account balance'));
        }

        $account->decrement('freeze', $amount);
    }

    /**
     * @param UserAccount $account
     * @param $amount
     */
    public function freeze(UserAccount $account, $amount)
    {
        // TODO: Implement freeze() method.
        $amount = floatval($amount);
        if ($amount > $account->balance) {
            abort(400, trans('account.insufficient account balance'));
        }

        $account->balance = bcsub($account->balance, $amount, 2);
        $account->freeze = bcadd($account->freeze, $amount, 2);
        $account->save();
    }

    /**
     * @param UserAccount $account
     * @param $amount
     */
    public function unFreeze(UserAccount $account, $amount)
    {
        // TODO: Implement unFreeze() method.
        $amount = floatval($amount);
        if ($amount > $account->freeze) {
            abort(400, trans('account.insufficient account balance'));
        }

        $account->balance = bcadd($account->balance, $amount, 2);
        $account->freeze = bcsub($account->freeze, $amount, 2);
        $account->save();
    }
}
