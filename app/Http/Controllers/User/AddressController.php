<?php

namespace App\Http\Controllers\User;


use App\Traits\User\AddressTrait;
use Illuminate\Support\Facades\Auth;

class AddressController extends BaseController
{
    use AddressTrait;
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $items = $this->addressRepository()->where('uid',Auth::id())
            ->orderByDesc('isdefault')->orderBy('address_id')->get();
        return $this->view('user.address.address', ['items'=>$items, 'menu'=>'address']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function frame()
    {

        $address_id = $this->request->get('address_id');
        if ($address_id){
            $address = $this->addressRepository()->firstOrFail($address_id);
        } else {
            $address = $this->addressRepository()->make([]);
        }
        return $this->view('user.address.frame', compact('address_id', 'address'));
    }
}
