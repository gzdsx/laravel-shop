<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    public function index(Request $request)
    {

    }

    public function detail(Request $request, $pageid)
    {

        $page = Page::findOrFail($pageid);
        return $this->view('h5.page.detail', compact('page'));
    }
}
