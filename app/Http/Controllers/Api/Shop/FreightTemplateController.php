<?php

namespace App\Http\Controllers\Api\Shop;

use App\Http\Controllers\Api\BaseController;
use App\Models\FreightTemplate;
use Illuminate\Http\Request;

class FreightTemplateController extends BaseController
{
    public function getAll(Request $request)
    {
        return jsonSuccess(['items' => FreightTemplate::all()]);
    }
}
