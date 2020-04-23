<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreightTemplate;
use Illuminate\Http\Request;

class FreightTemplateController extends BaseController
{
    public function getAll(Request $request){
        return ajaxReturn(['items'=>FreightTemplate::all()]);
    }
}
