<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends BaseController
{
    public function index(Request $request){
        return $this->view('h5.address.index');
    }
}
