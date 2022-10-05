<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Traits\User\UserAddressTrait;
use Illuminate\Http\Request;

class AddressController extends BaseController
{
    use UserAddressTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){
        return $this->save($request);
    }
}
