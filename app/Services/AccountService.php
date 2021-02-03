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


use App\Models\Account;
use App\Services\Contracts\AccountServiceInterface;

class AccountService implements AccountServiceInterface
{
    /**
     * @param Account $account
     * @param $amount
     */
    public function incrementBalance(Account $account, $amount)
    {
        // TODO: Implement incrementBalance() method.
        if ($amount) $account->increment('balance', floatval($amount));
    }

    /**
     * @param Account $account
     * @param $amount
     */
    public function decrementBalance(Account $account, $amount)
    {
        // TODO: Implement decrementBalance() method.
        $amount = floatval($amount);
        if ($amount > $account->balance) {
            abort(400, trans(trans('wallet.insufficient account balance')));
        } else {
            $account->increment('balance', $amount);
        }
    }

    /**
     * @param Account $account
     * @param $amount
     */
    public function incrementFreeze(Account $account, $amount)
    {
        // TODO: Implement incrementFreeze() method.
        if ($amount) $account->increment('freeze', floatval($amount));
    }

    /**
     * @param Account $account
     * @param $amount
     */
    public function decrementFreeze(Account $account, $amount)
    {
        // TODO: Implement decrementFreeze() method.
        $amount = floatval($amount);
        if ($amount > $account->freeze) {
            abort(400, trans(trans('wallet.insufficient account balance')));
        } else {
            $account->decrement('freeze', floatval($amount));
        }
    }

    /**
     * @param Account $account
     * @param $amount
     */
    public function freeze(Account $account, $amount)
    {
        // TODO: Implement freeze() method.
        $amount = floatval($amount);
        if ($amount > $account->balance) {
            abort(400, trans(trans('wallet.insufficient account balance')));
        } else {
            $account->balance -= $amount;
            $account->freeze += $amount;
            $account->save();
        }
    }

    /**
     * @param Account $account
     * @param $amount
     */
    public function unFreeze(Account $account, $amount)
    {
        // TODO: Implement unFreeze() method.
        $amount = floatval($amount);
        if ($amount > $account->freeze) {
            abort(400, trans(trans('wallet.insufficient account balance')));
        } else {
            $account->balance += $amount;
            $account->freeze -= $amount;
            $account->save();
        }
    }
}