<?php

namespace App\Http\Controllers\Notify\Alipay;

use App\Events\Order\OrderPaid;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    const SUCCESS = 'success';
    const FAIL = 'fail';

    /**
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function paid(Request $request)
    {
        /**
         * stdClass Object
         * (
         * [gmt_create] => 2018-12-03 11:27:48
         * [charset] => utf-8
         * [gmt_payment] => 2018-12-03 11:27:55
         * [notify_time] => 2018-12-03 11:27:55
         * [subject] => 水城红心猕猴桃  一级果
         * [sign] => l5mCl+5nNN+VzMoDiuVFJO3RNbEt7ylH4dl1COi6F7gcG+e0Zg/w4cp4icjfqOQGAmcQRTH3kOVKdlxhXhFv4PngdXoZz1c76ccU1QQdNIi/hl/6T1EDOT46P6Qbn7XaLFhs0kSyLO+uHMLH1t1xLWp4gOOjTAzQ8TeOmrVmaVjpMDuKeensCnN34eKukefST/4v8Pn4poEzygWbMnj74+xXFwlLgnvZEvfiB6d28Rsb3zORJQc3Es4Qn3TU4EMnaGym75SY9vwjsYJht5aGHATMJx+HlYFEa0QSNllSes3OUeytwdnG7/MfmAct+MU5jWJZ05bbJxbMGX6nmGFu7A==
         * [buyer_id] => 2088002411781000
         * [invoice_amount] => 0.01
         * [version] => 1.0
         * [notify_id] => 2018120300222112755081001039134677
         * [fund_bill_list] => [{"amount":"0.01","fundChannel":"ALIPAYACCOUNT"}]
         * [notify_type] => trade_status_sync
         * [out_trade_no] => 615438043178230610
         * [total_amount] => 0.01
         * [trade_status] => TRADE_SUCCESS
         * [trade_no] => 2018120322001481001018585081
         * [auth_app_id] => 2017090108501697
         * [receipt_amount] => 0.01
         * [point_amount] => 0.00
         * [app_id] => 2017090108501697
         * [buyer_pay_amount] => 0.01
         * [sign_type] => RSA2
         * [seller_id] => 2088521634578995
         * )
         */
        Storage::put('alipay', json_encode($request->all()));
        $out_trade_no = $request->input('out_trade_no');
        $order = Order::findByOrderNo($out_trade_no);
        if ($order->isUnPaid()) {
            DB::transaction(function () use ($order, $request) {
                $order->markAsPaid();
                //创建交易流水
                $transaction = new UserTransaction();
                $transaction->user()->associate($order->buyer_id);
                $transaction->out_trade_no = $order->order_no;
                $transaction->detail = $request->input('subject');
                $transaction->type = 2;
                $transaction->account_type = 1;
                $transaction->amount = $request->input('total_amount');
                $transaction->pay_type = 'alipay';
                $transaction->data = $request->all();
                $transaction->markAsPaid();
                //发送通知
                event(new OrderPaid($order));
            });
        }

        return static::SUCCESS;
    }
}
