<?php

namespace App\Http\Controllers\Api;


use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return ajaxReturn(['link' => Link::find($request->input('id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        if ($request->input('type') == 'category'){
            return ajaxReturn(['items' => Link::onlyCategory()->get()]);
        }
        return ajaxReturn(['items' => Link::onlyLink()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){
        $link = Link::findOrNew($request->input('id'));
        $link->fill($request->except('id'))->save();
        return ajaxReturn(['link'=>$link]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        Link::whereKey($request->input('items',[]))->delete();
        return ajaxReturn();
    }
}
