<?php

namespace App\Http\Controllers\Misc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $address = $this->request->input('address');
        $location = $this->request->input('location');
        $this->assign([
            'address'=>$address,
            'location'=>$location ? explode(',', $location) : [0,0]
        ]);

        return $this->view('widget.map_picker');
    }
}
