<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Support\VideoParser;
use Illuminate\Http\Request;

class UpgradeController extends Controller
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(Request $request)
    {

        $res = VideoParser::parse('https://v.youku.com/v_show/id_XMTI5NjExOTQyOA==.html');
        dd($res);
    }
}
