<?php

namespace App\Http\Controllers\Live;

use App\Http\Controllers\Controller;
use App\Models\CommonBlockItem;
use App\Models\Live;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $images = CommonBlockItem::whereBlockId(4)->get();
        $items = Live::orderByDesc('id')->paginate();
        return $this->view('live.index', compact('images', 'items'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $id)
    {
        $live = Live::findOrFail($id);
        $live->load(['user', 'channel']);

        $items = Live::orderByDesc('id')->limit(10)->get();

        return $this->view('live.detail', compact('live', 'items'));
    }
}
