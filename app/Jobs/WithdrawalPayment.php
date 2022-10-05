<?php

namespace App\Jobs;

use App\Models\UserTransaction;
use App\Models\UserWithrawalLog;
use App\Support\TradeUtil;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class WithdrawalPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use WechatDefaultConfig;

    public $log;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserWithrawalLog $withrawalLog)
    {
        $this->log = $withrawalLog;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::transaction(function () {
            $user = $this->log->user;
            $account = $user->account()->firstOrCreate();
            $sevice_fee = 0;
            $amount = $this->log->amount - $sevice_fee;

            $transaction_no = TradeUtil::createTransactionNo();
            $res = $this->payment()->transfer->toBalance([
                'partner_trade_no' => $transaction_no, // 商户订单号，需保持唯一性(只能是字母或者数字，不能包含有符号)
                'openid' => $user->connects()->first()->openid,
                'check_name' => 'NO_CHECK', // NO_CHECK：不校验真实姓名, FORCE_CHECK：强校验真实姓名
                're_user_name' => $user->username, // 如果 check_name 设置为FORCE_CHECK，则必填用户真实姓名
                'amount' => $amount * 100, // 企业付款金额，单位为分
                'desc' => '提现', // 企业付款操作说明信息。必填
            ]);

            if ($res['result_code'] == 'FAIL') {
                abort(500, $res['return_msg'] . ':' . $res['err_code_des']);
            }else{
                $account->freeze-=$amount;
                $account->save();

                $transaction = new UserTransaction();
                $transaction->out_trade_no = $transaction_no;
                $transaction->type = 2;
                $transaction->account_type = 2;
                $transaction->detail = '提现';
                $transaction->amount = $amount;
                $transaction->pay_type = 'balance';
                $transaction->pay_state = 1;
                $transaction->pay_at = now();
                $transaction->user()->associate($user);
                $transaction->save();

                if ($sevice_fee) {
                    $transaction = new UserTransaction();
                    $transaction->out_trade_no = TradeUtil::createTransactionNo();
                    $transaction->type = 2;
                    $transaction->account_type = 2;
                    $transaction->detail = '提现手续费';
                    $transaction->amount = $sevice_fee;
                    $transaction->pay_type = 'balance';
                    $transaction->pay_state = 1;
                    $transaction->pay_at = now();
                    $transaction->user()->associate($user);
                    $transaction->save();
                }

                $this->log->state = 1;
                $this->log->save();
            }
        });
    }
}
