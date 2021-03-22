<?php

namespace App\Http\Controllers\H5;


use App\Traits\Product\ProductTrait;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    use ProductTrait;

    /**
     * @param Request $request
     * @param $itemid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $itemid)
    {
        return $this->view('h5.product.detail',compact('itemid'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request){

        return $this->view('h5.product.search');
    }
}
