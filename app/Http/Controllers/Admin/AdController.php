<?php

namespace App\Http\Controllers\Admin;


use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return ajaxReturn(['ad' => Ad::findOrNew($request->input('id'))]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function batchget(Request $request)
    {
        return ['items' => Ad::all()];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $ad = Ad::findOrNew($request->input('id'));
        $ad->fill($request->input('ad', []))->save();
        return ajaxReturn(['ad' => $ad]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        Ad::whereKey($request->input('items', []))->delete();
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        Ad::whereKey($request->input('items', []))->update($request->input('params', []));
        return ajaxReturn();
    }
}
