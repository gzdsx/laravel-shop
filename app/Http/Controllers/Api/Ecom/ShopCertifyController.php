<?php

namespace App\Http\Controllers\Api\Ecom;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class ShopCertifyController extends BaseController
{

    use HasEcomShopSession;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function certify(Request $request)
    {
        $certify = $this->shop()->certify()->firstOrCreate();
        return jsonSuccess(['certify' => $certify]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $certify = $this->shop()->certify()->firstOrNew();
        $certify->fill($request->input('certify', []));
        $certify->save();

        return jsonSuccess();
    }
}
