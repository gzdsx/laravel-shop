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

namespace App\Traits\Foundation;


use App\Models\FreightTemplate;
use Illuminate\Http\Request;

trait FreightTemplateTrait
{
    /**
     * @return FreightTemplate|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return FreightTemplate::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return jsonSuccess(['template' => $this->repository()->find($request->input('template_id'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
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
