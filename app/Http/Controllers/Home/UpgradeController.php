<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Support\VideoParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpgradeController extends Controller
{

    public function index(Request $request)
    {

        return 'ok';
    }
}
