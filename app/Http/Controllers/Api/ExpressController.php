<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Express;
use Illuminate\Http\Request;

class ExpressController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        return ajaxReturn(['items' => Express::all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $express = Express::findOrNew($request->input('id'));
        $express->fill($request->input('express', []))->save();
        return ajaxReturn(['express' => $express]);
    }

    /**
     * @param Request $request
     */
    public function delete(Request $request)
    {
        Express::whereKey($request->input('items', []))->delete();
    }
}
