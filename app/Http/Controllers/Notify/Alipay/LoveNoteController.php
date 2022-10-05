<?php

namespace App\Http\Controllers\Notify\Alipay;

use App\Http\Controllers\Controller;
use App\Models\LoveNotePrepay;
use App\Models\UserTransaction;
use Illuminate\Http\Request;

class LoveNoteController extends Controller
{
    const SUCCESS = 'success';
    const FAIL = 'fail';

    /**
     * @param Request $request
     * @return string
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function paid(Request $request)
    {
        //Storage::put('alipay', json_encode($request->all()));
        $out_trade_no = $request->input('out_trade_no');
        $prepay = LoveNotePrepay::where('out_trade_no', $out_trade_no)->first();
        if ($prepay) {
            $transaction = new UserTransaction();
            $transaction->data = $request->all();
            $transaction->pay_state = 1;
            $transaction->pay_at = now();
            $transaction->pay_type = 'alipay';
            $transaction->detail = $request->input('subject');
            $transaction->amount = $request->input('total_amount');
            $transaction->type = 2;
            $transaction->account_type = 3;
            $transaction->out_trade_no = $out_trade_no;
            $transaction->user()->associate($prepay->uid);
            $transaction->save();
            //写入记录
            $prepay->user->drawnNotes()->syncWithoutDetaching([$prepay->note_id]);
        }
        return static::SUCCESS;
    }
}
