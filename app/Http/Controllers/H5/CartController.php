<?php

namespace App\Http\Controllers\H5;

use App\Traits\Mall\CartTrait;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    use CartTrait;

    /**
     * CartController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['wechat.oauth']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return $this->showCart($request);
    }

    /**
     * @param Request $request
     * @param $items
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showCartView(Request $request, $items)
    {
        return $this->view('h5.cart', compact('items'));
    }
}
