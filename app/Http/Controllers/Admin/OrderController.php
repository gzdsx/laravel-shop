<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderController extends BaseController
{
    protected $orderRepository;

    public function __construct(Request $request, OrderRepositoryInterface $orderRepository)
    {
        parent::__construct($request);
        $this->orderRepository = $orderRepository;
    }

    /**
     * 订单列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $this->assign(array_merge([
            'tab' => 'all',
            'order_no' => '',
            'seller_name' => '',
            'buyer_name' => '',
            'order_state' => '',
            'pay_type' => '',
            'time_begin' => '',
            'time_end' => ''
        ], $request->all()));
        $orders = $this->orderRepository->with('items')->filter($request->all())
            ->orderByDesc('order_id')->paginate();
        return $this->view('admin.order.orders', [
            'orders' => $orders,
            'pagination' => $orders->appends($request->except('page'))->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->orderRepository->whereKey($request->input('items', []))->delete();
        return ajaxReturn();
    }

    /**
     * 订单详情
     */
    public function detail(Request $request)
    {
        $order_id = $request->get('order_id');
        $order = $this->orderRepository->with(['items', 'shipping', 'buyer'])->findOrFail($order_id);
        return $this->view('admin.order.detail', compact('order_id', 'order'));
    }

    public function export()
    {

        $orders = [
            [
                '订单号',
                '产品',
                '单价',
                '数量',
                '卖家',
                '买家',
                '运费',
                '小计',
                '下单时间'
            ]
        ];

        $query = Order::with('items');

        $order_no = $this->request->get('order_no');
        if ($order_no) {
            $query = $query->where('order_no', $order_no);
        }

        $seller_name = $this->request->input('seller_name');
        if ($seller_name) {
            $query = $query->where('seller_name', $seller_name);
        }

        $buyer_name = $this->request->get('buyer_name');
        if ($buyer_name) {
            $query = $query->where('buyer_name', $buyer_name);
        }

        $trade_status = intval($this->request->get('trade_status'));
        if ($trade_status) {
            $query = $query->where('trade_status', $trade_status);
        }

        $pay_type = intval($this->request->get('pay_type'));
        if ($pay_type) {
            $query = $query->where('pay_type', $pay_type);
        }

        $time_begin = $this->request->get('time_begin');
        if ($time_begin) {
            $query = $query->where('created_at', '>', strtotime($time_begin));
        }

        $time_end = $this->request->get('time_end');
        if ($time_end) {
            $query = $query->where('created_at', '<', strtotime($time_end));
        }

        $query->orderByDesc('order_id')->limit(10000)->get()->map(function (Order $order) use (&$orders) {
            $item = $order->items->first();
            $orders[] = [
                "$order->order_no",
                $item->title,
                $item->price,
                $item->quantity,
                $order->shop_name,
                $order->buyer_name,
                $order->shipping_fee,
                $order->total_fee,
                @date('Y-m-d H:i:s', $order->created_at)
            ];
        });

        $collection = new Collection($orders);
        return $collection->downloadExcel(
            'orderTable.xls',
            'Xls',
            false
        );
    }
}
