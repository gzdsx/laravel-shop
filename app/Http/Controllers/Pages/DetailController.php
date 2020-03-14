<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages;

class DetailController extends BaseController
{
    /**
     * 页面详情
     */
    public function index($pageid) {

        $pageData = Pages::where('pageid', $pageid)->first();
        $this->assign(['pageData'=>$pageData]);

        //文章分类
        $categoryList = Pages::where('type', 'category')->orderBy('displayorder')->get(['pageid','title']);
        $this->assign(['categoryList'=>$categoryList]);

        //文章列表
        $this->data['pageList'] = [];
        $pageList = Pages::where('type', 'page')
            ->orderBy('displayorder')
            ->get(['pageid','title','catid'])->map(function ($page){
                $this->data['pageList'][$page->catid][$page->pageid] = $page;
            });

        return $this->view('pages.detail');
    }
}
