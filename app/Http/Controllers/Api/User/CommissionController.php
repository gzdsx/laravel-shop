<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommissionController extends BaseController
{
    /**
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function withdrawal(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $amount = $request->input('amount', 0);
            $account = Auth::user()->account()->firstOrCreate();
            if ($amount > $account->commission) {
                abort('提现金额不能大于账户余额');
            }

            $account->commission -= $amount;
            $account->save();

            Auth::user()->withdrawalLogs()->create([
                'amount' => $amount,
                'state' => 0
            ]);

            return jsonSuccess();
        });
    }
}
