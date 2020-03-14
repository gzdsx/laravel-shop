<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class YouxuanController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $itemlist = DB::table('item_push AS p')
            ->leftJoin('item AS i', 'i.itemid', '=', 'p.itemid')
            ->where(['i.on_sale'=>1, 'p.groupid'=>3])->paginate(50);

        $this->assign([
            'pagination'=>$itemlist->links(),
            'itemlist'=>$itemlist->map(function ($item){
                return get_object_vars($item);
            })
        ]);

        return $this->view('home.youxuan');
    }
}
