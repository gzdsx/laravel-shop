<?php

namespace App\Http\Controllers\H5;

use App\Repositories\Contracts\AddressRepositoryInterface;
use App\Traits\Auction\AuctionTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    use AuctionTrait;

    /**
     * AuctionController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['wechat.oauth']);
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
        return $this->view('h5.order.buynow', compact('item', 'address'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(Request $request){
        $items = $this->cartRepository()->where('uid',Auth::id())->whereIn('itemid',explode(',',$request->input('items')))->get();
        $address = app(AddressRepositoryInterface::class)->getDefaultAddress();

        return $this->view('h5.order.comfirm',compact('items','address'));
    }
}
