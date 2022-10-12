<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EcomProductContent;
use Illuminate\Http\Request;

class ProductContentController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $model = EcomProductContent::whereItemid($request->input('itemid'))->first();

        return jsonSuccess($model);
    }
}
