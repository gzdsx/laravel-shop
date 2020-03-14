<?php

namespace App\Http\Controllers\User;

use App\Library\Mall\Buyer\BoughtManagers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BoughtController extends BaseController
{
    use BoughtManagers;
    /**
     * TradeController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->assign(['menu'=>'bought']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $queryParams = [
            'tab'=>'all',
            'order_no'=>'',
            'shop_name'=>'',
            'pay_type'=>'',
            'time_begin'=>'',
            'time_end'=>'',
            'title'=>''
        ];
        $query = $this->user->boughts()->with('items')->where('buyer_deleted', 0);

        $tab = $request->get('tab');
        if ($tab) {
            $queryParams['tab'] = $tab;
            if ($tab == 'waitPay'){
                $query = $query->where('order_state', 1);
            }elseif ($tab == 'waitSend'){
                $query = $query->where('order_state', 2);
            }elseif ($tab == 'waitConfirm'){
                $query = $query->where('order_state', 3);
            }elseif ($tab == 'waitRate'){
                $query = $query->where('order_state', 4);
            }elseif ($tab == 'refunding') {
                $query = $query->where('order_state', 5);
            }elseif ($tab == 'closed') {
                $query = $query->where('order_state', 6);
            }
        }


        $order_no = $request->input('order_no');
        if ($order_no){
            $queryParams['order_no'] = $order_no;
            $query = $query->where('order_no', $order_no);
        }

        $shop_name = $request->input('shop_name');
        if ($shop_name) {
            $queryParams['shop_name'] = $shop_name;
            $query = $query->where('shop_name', 'LIKE', "%$shop_name%");
        }

        $pay_type = $request->input('pay_type', 0);
        if ($pay_type) {
            $queryParams['pay_type'] = $pay_type;
            $query = $query->where('pay_type', $pay_type);
        }

        $title = $request->input('title');
        if ($title) {
            $queryParams['title'] = $title;
            $query = $query->whereHas('items', function (Builder $builder) use ($title){
                return  $builder->where('title', 'LIKE', "%$title%");
            });
        }

        $time_begin = $request->input('time_begin');
        if ($time_begin) {
            $queryParams['time_begin'] = $time_begin;
            $query = $query->where('created_at', '>', strtotime($time_begin));
        }

        $time_end = $request->input('time_end');
        if ($time_end) {
            $queryParams['time_end'] = $time_end;
            $query = $query->where('created_at', '<', strtotime($time_end));
        }
        $this->assign($queryParams);

        $orders = $query->orderByDesc('order_id')->paginate(10);
        return $this->view('user.bought.index', [
            'orders'=>$orders,
            'pagination'=>$orders->appends($queryParams)->render()
        ]);
    }
}
