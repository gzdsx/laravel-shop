<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-23
 * Time: 18:01
 */

namespace App\Repositories\Eloquent;


use App\Models\Settings;
use App\Repositories\Contracts\SettingsRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class SettingsRepository extends BaseRepository implements SettingsRepositoryInterface
{
    public function model()
    {
        // TODO: Implement model() method.
        return Settings::class;
    }

    /**
     * @throws \Exception
     */
    public function updateCache()
    {
        // TODO: Implement updateCache() method.
        $settings = [];
        foreach ($this->all() as $setting) {
            $svalue = json_decode($setting->svalue, true);
            $settings[$setting->skey] = is_array($svalue) ? $svalue : $setting->svalue;
        }
        Cache::forever('settings', $settings);
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function fetchFromCache()
    {
        // TODO: Implement fetchFromCache() method.
        $settings = Cache::get('settings');
        if (is_array($settings)) {
            return collect($settings);
        } else {
            $this->updateCache();
            return $this->fetchFromCache();
        }
    }
}
