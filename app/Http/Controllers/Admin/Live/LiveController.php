<?php

namespace App\Http\Controllers\Admin\Live;


use App\Http\Controllers\Admin\BaseController;
use App\Models\Live;
use App\Traits\Live\LiveTrait;
use Illuminate\Http\Request;

class LiveController extends BaseController
{
    use LiveTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Live::withoutGlobalScopes();
    }
}
