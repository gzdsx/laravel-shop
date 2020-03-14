<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-20
 * Time: 00:37
 */

namespace App\Traits\Common;


use App\Support\Pinyin;
use Illuminate\Http\Request;

trait CatlogManagerTrait
{

    /**
     *  @return \App\Repositories\Contracts\CatlogRepositoryInterface
     */
    abstract function catlogRepository();
    /**
     * @param Request $request
     * @return mixed
     */
    public function showCatlogs(Request $request)
    {
        $catlogs = $this->catlogRepository()->fetchAll(0, false);
        return $this->showCatlogsView($request, $catlogs);
    }

    /**
     * @param Request $request
     * @param $catlogs
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showCatlogsView(Request $request, $catlogs)
    {
        return ajaxReturn(compact('catlogs'));
    }

    /**
     * @param Request $request
     * @return Request
     */
    public function batchUpdate(Request $request)
    {
        $catlogs = $request->input('catlogs', []);
        if ($catlogs) {
            $pinyin = new Pinyin();
            foreach ($catlogs as $catid => $catlog) {
                if ($catlog['name']) {
                    if (!$catlog['identifier']) {
                        $catlog['identifier'] = $pinyin->getPinyin($catlog['name']);
                    }
                    $catlog['enable'] = isset($catlog['enable']) ? 1 : 0;
                    $catlog['available'] = isset($catlog['available']) ? 1 : 0;
                    $catlog['displayorder'] = intval($catlog['displayorder']);
                    $this->catlogRepository()->whereKey($catid)->update($catlog);
                }
            }
        }
        $this->catlogRepository()->updateCache();
        return $this->sendBatchUpdatedResponse($request);
    }

    /**
     * @param Request $request
     * @return Request
     */
    protected function sendBatchUpdatedResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function newCatlog(Request $request)
    {

        $catid = $request->input('catid');
        if (!$catlog = $this->catlogRepository()->find($catid)) {
            $catlog = $this->catlogRepository()->make([]);
        }
        $catlogs = $this->catlogRepository()->fetchAll(0, false);
        return $this->showCatlogForm($request, $catlog, $catlogs);
    }

    /**
     * @param Request $request
     * @param $catlog
     * @param $catlogs
     * @return mixed
     */
    protected function showCatlogForm(Request $request, $catlog, $catlogs)
    {
        return compact('catlog', 'catlogs');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $catid = $request->input('catid', 0);
        $newCatlog = $request->post('catlog', []);
        if ($catid) {
            $catlog = $this->catlogRepository()->find($catid);
            if ($catlog) $catlog->update($newCatlog);
        } else {
            $catlog = $this->catlogRepository()->create($newCatlog);
        }
        $this->catlogRepository()->updateCache();
        return $this->sendSavedResponse($request, $catlog);
    }

    /**
     * @param Request $request
     * @param $catlog
     * @return mixed
     */
    protected function sendSavedResponse(Request $request, $catlog)
    {
        return $catlog;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function delete(Request $request)
    {
        $catid = $request->input('catid', 0);
        $catlog = $this->catlogRepository()->find($catid);
        $catlogs = $this->catlogRepository()->fetchAll(0, false);
        return $this->showDeleteForm($request, $catlog, $catlogs);
    }

    /**
     * @param Request $request
     * @param $catlog
     * @param $catlogs
     * @return array
     */
    protected function showDeleteForm(Request $request, $catlog, $catlogs)
    {
        return compact('catlog', 'catlogs');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function execDelete(Request $request)
    {
        $catid = $request->input('catid', 0);
        $this->catlogRepository()->destroy($catid);
        $this->afterDeleted($request, $catid);
        $this->catlogRepository()->updateCache();
        return $this->sendDeletedResponse($request);
    }

    /**
     * @param Request $request
     * @param $catid
     */
    protected function afterDeleted(Request $request, $catid)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendDeletedResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function merge(Request $request)
    {
        $catlogs = $this->catlogRepository()->fetchAll(0, false);
        return $this->showMergeForm($request, $catlogs);
    }

    /**
     * @param Request $request
     * @param $catlogs
     * @return mixed
     */
    protected function showMergeForm(Request $request, $catlogs)
    {
        return $catlogs;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function execMerge(Request $request)
    {
        $target = $request->post('target', 0);
        $source = $request->post('source', []);
        if ($source && $target) {
            foreach ($source as $catid) {
                if ($catid != $target){
                    $this->catlogRepository()->destroy($catid);
                }
            }
            $this->afterMerged($request, $source, $target);
            $this->catlogRepository()->updateCache();
        }
        return $this->sendMergedResponse($request);
    }

    /**
     * @param Request $request
     * @param $source
     * @param $target
     */
    protected function afterMerged(Request $request, $source, $target)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendMergedResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setIcon(Request $request)
    {
        $catid = $request->post('catid');
        $icon = $request->post('icon');
        $this->catlogRepository()->whereKey($catid)->update(['icon' => $icon]);
        $this->catlogRepository()->updateCache();
        return ajaxReturn();
    }
}
