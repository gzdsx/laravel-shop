<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    public function detail($id)
    {
        $page = Page::findOrFail($id);

        return $this->view('h5.page.detail', compact('page'));
    }
}
