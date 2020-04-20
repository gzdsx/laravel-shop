<?php

namespace App\Http\Controllers\Api;


use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends BaseController
{
    /**
     * @param Request $request
     * @return array
     */
    public function get(Request $request)
    {
        return ['pages' => Pages::findOrNew($request->input('pageid'))];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        if ($catid = $request->input('catid')) {
            $items = Pages::onlyPage()->where('catid', $catid)->get();
        } else {
            $items = Pages::onlyPage()->get();
        }

        return ajaxReturn(['items' => $items]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchgetCatlog()
    {
        $items = Pages::onlyCategory()->get();
        return ajaxReturn(['items' => $items]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $pageid = $request->input('pageid', 0);
        $pages = Pages::findOrNew($pageid)->fill($request->all())->save();
        return ajaxReturn(['pages' => $pages]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        Pages::whereKey($request->input('items', []))->delete();
        return ajaxReturn();
    }
}
