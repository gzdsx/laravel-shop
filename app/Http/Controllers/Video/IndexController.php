<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Models\BlockItem;
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
        $images = BlockItem::whereBlockId(6)->get();
        $items = Video::orderByDesc('id')->paginate();
        return $this->view('video.index', compact('images', 'items'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $items = Video::orderByDesc('id')->limit(10)->get();
        return $this->view('video.detail', compact('video', 'items'));
    }
}
