<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use App\Models\UserTransaction;
use App\Models\UserTransferCommonly;
use App\Support\TradeUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAccount()
    {
        $account = Auth::user()->account()->firstOrCreate();
        return jsonSuccess(['account' => $account]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'bail|required|string|pwd'
        ]);

        $account = Auth::user()->account()->firstOrCreate();
        $account->password = bcrypt($request->input('password'));
        $account->save();

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function transfer(Request $request)
    {
        $fromUser = Auth::user();
        $toUser = User::findOrFail($request->input('uid'));
        $amount = $request->input('amount', 0);
        $remark = $request->input('remark', '');
        $password = $request->input('password', '');

        return DB::transaction(function () use ($fromUser, $toUser, $amount, $remark, $password) {
            $fromAccount = $fromUser->account;
            if (!$fromAccount->password) {
                abort(500, '请先到安全中心设置支付密码');
            }

            if (!Hash::check($password, $fromAccount->password)) {
                abort(500, trans('user.password incorrect'));
            }

            if ($fromUser->uid == $toUser->uid) {
                abort(500, '不能给自己转账');
            }

            $fromAccount->balance -= $amount;
            $fromAccount->save();

            $transaction = new UserTransaction();
            $transaction->out_trade_no = TradeUtil::createTransactionNo();
            $transaction->type = 2;
            $transaction->account_type = 3;
            $transaction->user()->associate($fromUser);
            $transaction->other_account_id = $toUser->uid;
            $transaction->other_account_name = $toUser->username;
            $transaction->detail = '转账-转给' . $toUser->username;
            $transaction->remark = $remark;
            $transaction->amount = $amount;
            $transaction->markAsPaid();

            $toAccount = $toUser->account;
            $toAccount->balance += $amount;
            $toAccount->save();

            $transaction = new UserTransaction();
            $transaction->out_trade_no = TradeUtil::createTransactionNo();
            $transaction->type = 1;
            $transaction->account_type = 3;
            $transaction->user()->associate($toUser);
            $transaction->other_account_id = $fromUser->uid;
            $transaction->other_account_name = $fromUser->username;
            $transaction->detail = '转账-来自' . $fromUser->username;
            $transaction->remark = $remark;
            $transaction->amount = $amount;
            $transaction->markAsPaid();

            UserTransferCommonly::firstOrCreate([
                'uid' => $fromUser->uid,
                'payee_id' => $toUser->uid
            ]);

            return jsonSuccess();
        });
    }
}
