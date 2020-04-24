<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreightTemplate;
use Illuminate\Http\Request;

class FreightTemplateController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return ajaxReturn(['template' => FreightTemplate::findOrFail($request->input('template_id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        return ajaxReturn(['items' => FreightTemplate::all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        FreightTemplate::whereKey($request->input('template_id'))->delete();
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $template = FreightTemplate::findOrNew($request->input('template_id'));
        $template->fill($request->input('template', []))->save();
        return ajaxReturn(['template' => $template]);
    }
}
