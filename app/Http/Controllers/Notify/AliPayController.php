<?php

namespace App\Http\Controllers\Notify;


use Alipay\Factory;
use App\Jobs\OrderProcessNotice;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AliPayController extends Controller
{
    /**
     * @param Request $request
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function index(Request $request)
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
        $out_trade_no = $request->input('out_trade_no');
        $res = Factory::query()->sendRequest(compact('out_trade_no'));
        if ($res['trade_status'] == 'TRADE_SUCCESS') {
            $transaction = Transaction::findByOutTradeNo($out_trade_no);
            if (!$transaction->pay_state) {
                $transaction->extra = $request->all();
                $transaction->transaction_state = 2;
                $transaction->pay_state = 1;
                $transaction->pay_at = now();
                $transaction->pay_type = 'alipay';
                $transaction->save();
            }

            if ($transaction->order) {
                if (!$transaction->order->pay_state) {
                    $transaction->order->order_state = 2;
                    $transaction->order->pay_state = 1;
                    $transaction->order->pay_at = now();
                    $transaction->order->save();

                    dispatch(new OrderProcessNotice($transaction->order, 'paid'));
                }
            }
        }
    }
}
