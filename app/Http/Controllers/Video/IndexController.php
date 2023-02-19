<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Models\BlockItem;
use App\Models\CommonBlockItem;
use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $images = CommonBlockItem::whereBlockId(6)->get();
        $items = Video::orderByDesc('vid')->paginate();
        return $this->view('video.index', compact('images', 'items'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $vid)
    {
        $video = Video::findOrFail($vid);
        $items = Video::orderByDesc('vid')->limit(10)->get();
        return $this->view('video.detail', compact('video', 'items'));
    }
}
