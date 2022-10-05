<?php

namespace App\Http\Controllers\Admin\Ecom;

use App\Http\Controllers\Admin\BaseController;
use App\Traits\Ecom\EcomFreightTemplateTrait;
use Illuminate\Http\Request;

class FreightTemplateController extends BaseController
{
    use EcomFreightTemplateTrait;
}
