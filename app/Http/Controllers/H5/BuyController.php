<?php

namespace App\Http\Controllers\H5;


use App\Repositories\Contracts\AddressRepositoryInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use Illuminate\Http\Request;

class BuyController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['wechat.oauth']);
    }

    /**
     * @return ItemRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function itemRepository()
    {
        return app(ItemRepositoryInterface::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function buynow(Request $request)
    {
        $itemid = $request->input('itemid');
        $item = $this->itemRepository()->findOrFail($itemid);

        $address = app(AddressRepositoryInterface::class)->getDefaultAddress();
        return $this->view('h5.buynow', compact('item', 'address'));
    }
}
