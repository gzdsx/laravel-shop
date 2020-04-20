<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\User\AddressTrait;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use AddressTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){
        return $this->store($request);
    }
}
