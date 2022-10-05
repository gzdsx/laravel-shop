<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Models\UserWithrawalLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends BaseController
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|UserWithrawalLog
     */
    protected function repository()
    {
        return Auth::user()->withdrawalLogs();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apply(Request $request)
    {
        $amount = $request->input('amount');
        if (!$amount) {
            abort(500, 'missing amount value');
        }

        $account = Auth::user()->account()->firstOrCreate();
        if ($amount > $account->balance) {
            abort(500, trans('account.insufficient account balance'));
        }

        $account->freeze += $amount;
        $account->balance -= $amount;
        $account->save();

        $log = $this->repository()->make();
        $log->amount = $amount;
        $log->state = 0;
        $log->save();

        return jsonSuccess();
    }
}
