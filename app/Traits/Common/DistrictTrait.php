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
     * @return District|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository(){
        return District::query();
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function get(Request $request)
    {
        $id = $request->input('id', 0);
        return jsonSuccess(['district' => $this->repository()->find($id)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function batchget(Request $request)
    {
        $fid = $request->input('fid', 0);
        return jsonSuccess(['items' => $this->repository()->where('fid', $fid)->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {

        $district = $this->repository()->findOrNew($request->input('id'));
        $district->fill($request->input('district', []));
        if (!$district->pinyin){
            $district->pinyin = PinyinUtil::pinyin($district->name);
        }

        if (!$district->letter){
            $district->letter = PinyinUtil::firstChar($district->name);
        }

        $district->save();
        return jsonSuccess(['district' => $district]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->delete();
        return jsonSuccess();
    }
}
