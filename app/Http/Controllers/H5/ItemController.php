<?php

namespace App\Http\Controllers\H5;

use App\Traits\Item\ItemManageTrait;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    use ItemManageTrait;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware(['wechat.oauth']);
    }

    public function detail(Request $request, $itemid)
    {
        $item = $this->getItemById($itemid);
        return $this->view('h5.item',compact('item'));
    }
}
