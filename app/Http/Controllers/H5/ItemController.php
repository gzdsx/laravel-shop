<?php

namespace App\Http\Controllers\H5;

use App\Traits\Item\ItemTrait;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    use ItemTrait;

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['wechat.oauth']);
    }

    protected function showDetailView(Request $request, $item)
    {

        return $this->view('h5.item', compact('item'));
    }
}
