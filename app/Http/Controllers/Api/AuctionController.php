<?php

namespace App\Http\Controllers\Api;

use App\Traits\Auction\AuctionTrait;
use Illuminate\Http\Request;

class AuctionController extends BaseController
{
    use AuctionTrait;
}
