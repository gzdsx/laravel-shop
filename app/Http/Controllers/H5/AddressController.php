<?php

namespace App\Http\Controllers\H5;

use App\Traits\User\AddressTrait;
use Illuminate\Http\Request;

class AddressController extends BaseController
{
    use AddressTrait;

    public function index(Request $request)
    {

        return $this->view('h5.address');
    }
}
