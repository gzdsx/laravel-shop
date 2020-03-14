<?php

namespace App\Http\Controllers\Material;

use App\Traits\Common\MaterialTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    use MaterialTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function imagePicker(Request $request)
    {
        $items = $this->materialRepository()->filter($request->all())->where('type','image')->orderByDesc('id')
            ->select(['id', 'name', 'thumb', 'source as image', 'width', 'height', 'size'])->paginate(20);
        return $this->view('widget.image_picker', [
            'items' => $items->all(),
            'pagination' => $items->render(),
        ]);
    }
}
