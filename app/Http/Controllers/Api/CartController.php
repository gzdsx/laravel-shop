<?php

namespace App\Http\Controllers\Api;

use App\Library\Mall\CartManagers;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    use CartManagers;
}
