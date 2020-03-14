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


use App\Repositories\Eloquent\DistrictRepository;
use Illuminate\Http\Request;

trait DistrictTrait
{
    /**
     * @return DistrictRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function districtRepository(){
        return app(DistrictRepository::class);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function get(Request $request)
    {
        $id = $request->input('id', 0);
        return ajaxReturn(['district' => $this->districtRepository()->findOrFail($id)]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $fid = $request->input('fid', 0);
        return ajaxReturn(['items' => $this->districtRepository()->where('fid', $fid)->orderBy('displayorder')->get()]);
    }
}
