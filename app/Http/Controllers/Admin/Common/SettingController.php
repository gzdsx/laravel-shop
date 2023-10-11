<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CommonSetting;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function settings(Request $request)
    {
        $settings = [];
        foreach (CommonSetting::all() as $setting) {
            $svalue = json_decode($setting->svalue, true);
            $settings[$setting->skey] = is_array($svalue) ? $svalue : $setting->svalue;
        }
        return json_success($settings);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(Request $request)
    {
        foreach ($request->input('settings', []) as $skey => $svalue) {
            if (is_array($svalue)) $svalue = json_encode($svalue);
            CommonSetting::updateOrCreate(['skey'=>$skey], ['svalue' => $svalue]);
        }

        $this->updateCache();
        return json_success();
    }

    /**
     * @throws \Exception
     */
    protected function updateCache()
    {
        $settings = [];
        foreach (CommonSetting::all() as $setting) {
            $svalue = json_decode($setting->svalue, true);
            $settings[$setting->skey] = is_array($svalue) ? $svalue : $setting->svalue;
        }
        cache()->forever('settings', $settings);
    }
}
