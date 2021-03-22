<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Models\Live;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LiveController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->view('h5.live.index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $id)
    {
        return $this->view('h5.live.detail', compact('id'));
    }
}
