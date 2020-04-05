<?php

namespace App\Http\Controllers\H5;

use App\Traits\Order\BoughtTrait;
use Illuminate\Http\Request;

class BoughtController extends BaseController
{
    use BoughtTrait;

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['wechat.oauth']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tab = $request->input('tab');
        return $this->view('h5.boughts', compact('tab'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $order = $this->getOrderForRequest($request);
        $order->load(['shipping', 'items', 'buyer']);

        return $this->view('h5.order', compact('order'));
    }
}
