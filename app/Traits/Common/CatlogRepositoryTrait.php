<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-19
 * Time: 23:17
 */

namespace App\Traits\Common;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

trait CatlogRepositoryTrait
{
    /**
     * @param int $fid
     * @param bool $withGlobalScopes
     * @return mixed
     */
    public function fetchAll($fid = 0, $withGlobalScopes = true)
    {
        // TODO: Implement fetchAll() method.
        if ($withGlobalScopes){
            return $this->model->with(['childs' => function (HasMany $hasMany) {
                return $hasMany->with('childs');
            }])->where('fid', $fid)->orderBy('displayorder')->get();
        }

        return $this->withoutGlobalScopes()->with(['childs' => function (HasMany $hasMany) {
            return $hasMany->withoutGlobalScopes()->with(['childs'=>function(HasMany $hasMany){
                return $hasMany->withoutGlobalScopes();
            }]);
        }])->where('fid', $fid)->orderBy('displayorder')->get();
    }

    /**
     * @param int $fid
     * @param bool $withGlobalScopes
     * @return array
     */
    public function fetchAllIds($fid = 0, $withGlobalScopes = true)
    {
        // TODO: Implement fetchAllIds() method.
        return array_merge([$fid], $this->getAllIds($this->fetchAll($fid, $withGlobalScopes)));
    }

    /**
     * @param int $fid
     * @param int $default
     * @param bool $withGlobalScopes
     * @return string
     */
    public function fetchOptions($fid = 0, $default = 0, $withGlobalScopes = true)
    {
        // TODO: Implement fetchOptions() method.
        return $this->buildOptions($this->fetchAll($fid, $withGlobalScopes), $default);
    }

    /**
     * @param Collection $catlogs
     * @return array
     */
    protected function getAllIds(Collection $catlogs)
    {
        $ids = $catlogs->pluck('catid')->toArray();
        foreach ($catlogs as $catlog) {
            $ids = array_merge($ids, $this->getAllIds($catlog->childs));
        }
        return $ids;
    }

    /**
     * @param Collection $catlogs
     * @param int $default
     * @param string $prefix
     * @return string
     */
    protected function buildOptions(Collection $catlogs, $default = 0, $prefix = '')
    {
        $options = '';
        foreach ($catlogs as $catlog) {
            $options .= '<option value="' . $catlog->catid . '"' . ($catlog->catid == $default ? ' selected="selected"' : '') . '>' . $prefix . $catlog->name . '</option>';
            $options .= $this->buildOptions($catlog->childs, $default, $prefix . '|--');
        }

        return $options;
    }

    /**
     * @return \Illuminate\Cache\CacheManager|mixed
     * @throws \Exception
     */
    public function fetchAllFromCache()
    {
        // TODO: Implement fetchAllFromCache() method.
        return cache($this->cacheName()) ?? $this->fetchAll();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function updateCache()
    {
        // TODO: Implement updateCache() method.
        return cache()->forever($this->cacheName(), $this->fetchAll());
    }

    /**
     * @return string
     */
    protected function cacheName(){
        return 'caches';
    }
}
