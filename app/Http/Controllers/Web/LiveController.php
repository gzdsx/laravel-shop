<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Live;
use Illuminate\Http\Request;

class LiveController extends BaseController
{
    protected $navName = 'live';

    public function index(Request $request)
    {
        $items = Live::orderByDesc('id')->paginate();
        return $this->view('web.live-home', compact('items'));
    }
}
