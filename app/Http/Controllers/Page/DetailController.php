<?php

namespace App\Http\Controllers\Page;

use App\Models\Page;

class DetailController extends BaseController
{
    /**
     * 页面详情
     */
    public function index($pageid)
    {

        $page = Page::findOrFail($pageid);
        $categories = Page::onlyCategory()->with('pages')->get();

        return $this->view('page.detail', compact('page', 'categories'));
    }
}
