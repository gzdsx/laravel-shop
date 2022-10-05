<?php

namespace App\Http\Controllers\Admin\Common;


use App\Http\Controllers\Admin\BaseController;
use App\Models\Material;
use App\Traits\Common\MaterialTrait;
use Illuminate\Http\Request;

class MaterialController extends BaseController
{
    use MaterialTrait;

    /**
     * @return Material|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Material::query();
    }
}
