<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2021 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2021/1/5
 * Time: 22:47
 */

namespace App\Traits\Ecom;


use App\Models\EcomFreightTemplate;
use Illuminate\Http\Request;

trait EcomFreightTemplateTrait
{
    /**
     * @return EcomFreightTemplate|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return EcomFreightTemplate::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        return jsonSuccess(['template' => $this->repository()->find($request->input('template_id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        return jsonSuccess(['items' => $this->repository()->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('template_id'))->delete();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $template = $this->repository()->findOrNew($request->input('template_id'));
        $template->fill($request->input('template', []))->save();
        return jsonSuccess(['template' => $template]);
    }
}
