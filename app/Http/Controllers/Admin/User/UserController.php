<?php

namespace App\Http\Controllers\Admin\User;


use App\Http\Controllers\Admin\BaseController;
use App\Models\User;
use App\Models\UserTransaction;
use App\Support\TradeUtil;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function info(Request $request)
    {
        $user = Auth::user();
        return json_success([
            'uid' => $user->uid,
            'nickname' => $user->nickname,
            'avatar' => $user->avatar,
            'phone' => $user->phone,
            'email' => $user->email
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        $model = $this->repository()->with('group')->find($request->input('uid'));
        return json_success($model);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function users(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        $query = $this->repository()->filter($request->all());
        return json_success([
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
        $newUser = $request->input('user', []);
        $model = $this->repository()->findOrNew($newUser['uid'] ?? 0);
        $isNewUser = !$model->uid;

        $nickname = $request->input('nickname');
        if ($model->nickname != $nickname) {
            if ($this->repository()->where('nickname', $nickname)->exists()) {
                return json_fail(trans('user.nickname has been taken'));
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
                    return json_fail(trans('user.mobile has been taken'));
                } else {
                    $model->phone = $phone;
                }
            }
        }


        if ($email = $request->input('email')) {
            if ($model->email != $email) {
                if ($this->repository()->where('email', $email)->exists()) {
                    return json_fail(trans('user.email has been taken'));
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

        if ($isNewUser) {
            event(new Registered($model));
        }

        return json_success();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->map(function (User $user) {
            if (!$user->isFounder()) {
                $user->delete();
            }
        });
        return json_success();
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
        return json_success();
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

        return json_success();
    }
}
