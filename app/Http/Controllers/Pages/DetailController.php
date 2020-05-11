<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages;

class DetailController extends BaseController
{
    /**
     * 页面详情
     */
    public function index($pageid)
    {

        $page = Pages::findOrFail($pageid);
        $pageList = Pages::onlyCategory()->with('pages')->get();

        return $this->view('pages.detail', compact('page', 'pageList'));
    }
}
