<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageCategory;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index(Request $request)
    {

    }

    public function detail($id)
    {

        $page = Page::findOrFail($id);
        $categories = PageCategory::with('pages')->get();

        return $this->view('page.detail', compact('page', 'categories'));
    }
}
