<?php

namespace App\Http\Controllers\H5;


use App\Models\User;
use App\Repositories\Contracts\PagesRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IndexController extends BaseController
{
    public function index(Request $request)
    {

        //dd(session()->all());
        //session()->forget('wechat');
        return $this->view('h5.index');
    }

    public function aboutus(Request $request)
    {
        $article = app(PagesRepositoryInterface::class)->find(33);

        return $this->view('h5.aboutus', compact('article'));
    }
}
