<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedBackController extends BaseController
{
    public function index(Request $request){
        return $this->view('h5.feedback.index');
    }
}
