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
use App\Support\PinyinUtil;
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $attributes = collect($request->input('district', []));
        if ($attributes->has('pinyin')) {
            if (!$attributes->get('pinyin')) {
                $attributes->put('pinyin', PinyinUtil::pinyin($attributes->get('name')));
            }
        }

        if ($attributes->has('letter')) {
            if (!$attributes->get('letter')) {
                $attributes->put('letter', PinyinUtil::firstChar($attributes->get('name')));
            }
        }

        if (!$attributes->get('level')) {
            if ($attributes->get('fid')) {
                $parent = District::find($attributes->get('fid'));
                $attributes->put('level', $parent->level + 1);
            } else {
                $attributes->put('level', 1);
            }
        }
        $district = District::findOrNew($request->input('id'));
        $district->fill($attributes->except('id')->toArray())->save();
        return ajaxReturn(['district' => $district]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        District::whereKey($request->input('items', []))->delete();
        return ajaxReturn();
    }
}
