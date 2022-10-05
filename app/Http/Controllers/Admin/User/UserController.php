<?php

namespace App\Http\Controllers\Admin\User;


use App\Http\Controllers\Admin\BaseController;
use App\Models\User;
use App\Models\UserTransaction;
use App\Support\TradeUtil;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{

    /**
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    public function repository()
    {
        return User::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $model = $this->repository()->with('group')->find($request->input('uid'));
        return jsonSuccess($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        $query = $this->repository()->filter($request->all());
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->with(['group', 'account'])->offset($offset)->limit($count)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $model = $this->repository()->findOrNew($request->input('uid'));

        $nickname = $request->input('nickname');
        if ($model->nickname != $nickname) {
            if ($this->repository()->where('nickname', $nickname)->exists()) {
                return jsonError(422, trans('user.nickname has been taken'));
            } else {
                $model->nickname = $nickname;
            }
        }

        if ($password = $request->input('password')) {
            $model->password = bcrypt($password);
        }


        if ($phone = $request->input('phone')) {
            if ($model->phone != $phone) {
                if ($this->repository()->where('phone', $phone)->exists()) {
                    return jsonError(422, trans('user.mobile has been taken'));
                } else {
                    $model->phone = $phone;
                }
            }
        }


        if ($email = $request->input('email')) {
            if ($model->email != $email) {
                if ($this->repository()->where('email', $email)->exists()) {
                    return jsonError(422, trans('user.email has been taken'));
                } else {
                    $model->email = $email;
                }
            }
        }

        if ($gid = $request->input('gid')) {
            $model->gid = $gid;
        }

        if ($avatar = $request->input('avatar')) {
            $model->avatar = $avatar;
        }

        $model->save();

        if (!$request->input('uid')) {
            event(new Registered($model));
        }

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->map(function (User $user) {
            if (!$user->isFounder()) {
                $user->delete();
            }
        });
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->map(function (User $user) use ($request) {
            if ($user->isFounder()) {
                $user->update($request->input('data', []));
            }
        });
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function recharge(Request $request)
    {
        $amount = abs($request->input('amount'));
        if ($amount > 0) {
            $user = User::find($request->input('uid'));
            DB::transaction(function () use ($user, $amount) {
                $account = $user->account()->firstOrCreate();
                $account->balance += $amount;
                $account->total_income += $amount;
                $account->save();

                $transaction = new UserTransaction();
                $transaction->out_trade_no = TradeUtil::createTransactionNo();
                $transaction->type = 1;
                $transaction->account_type = '6';
                $transaction->amount = $amount;
                $transaction->detail = '平台充值';
                $transaction->uid = $user->uid;
                $transaction->pay_type = 'balance';
                $transaction->markAsPaid();
            });
        }

        return jsonSuccess();
    }
}
