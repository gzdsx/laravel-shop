<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{
    public function index(){
        $user = Auth::user();
        $account = $user->account()->firstOrCreate([]);
        return $this->view('user.index', compact('user','account'));
    }
}
