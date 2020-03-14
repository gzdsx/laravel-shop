<?php

namespace App\Http\Controllers\Admin;


class IndexController extends BaseController
{
    public function index(){

        return $this->view('admin.admin');
    }

    public function wellcome(){
        return $this->view('admin.wellcome');
    }
}
