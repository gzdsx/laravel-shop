<?php

namespace App\Http\Controllers\Api;

use App\Traits\Mall\ItemManagerTrait;
use Illuminate\Http\Request;

class ItemManagerController extends BaseController
{
    use ItemManagerTrait;
}
