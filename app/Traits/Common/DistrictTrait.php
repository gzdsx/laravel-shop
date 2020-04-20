<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-26
 * Time: 08:57
 */

namespace App\Traits\Common;


use App\Models\District;
use Illuminate\Http\Request;

trait DistrictTrait
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function get(Request $request)
    {
        $id = $request->input('id', 0);
        return ajaxReturn(['district' => District::findOrFail($id)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function batchget(Request $request)
    {
        $fid = $request->input('fid', 0);
        return ajaxReturn(['items' => District::where('fid', $fid)->get()]);
    }
}
