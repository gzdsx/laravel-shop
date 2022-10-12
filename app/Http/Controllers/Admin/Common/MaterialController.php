<?php

namespace App\Http\Controllers\Admin\Common;


use App\Http\Controllers\Admin\BaseController;
use App\Models\CommonMaterial;
use App\Traits\Common\MaterialTrait;
use Illuminate\Http\Request;

class MaterialController extends BaseController
{
    use MaterialTrait;

    /**
     * @return CommonMaterial|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return CommonMaterial::query();
    }
}
