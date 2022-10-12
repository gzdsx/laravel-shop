<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use App\Models\CommonSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
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
        return jsonSuccess($settings);
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
            CommonSetting::updateOrInsert(['skey'=>$skey], ['svalue' => $svalue]);
        }

        $this->updateCache();
        return jsonSuccess();
    }

    /**
     * @throws \Exception
     */
    protected function updateCache()
    {
        // TODO: Implement updateCache() method.
        $settings = [];
        foreach (CommonSetting::all() as $setting) {
            $svalue = json_decode($setting->svalue, true);
            $settings[$setting->skey] = is_array($svalue) ? $svalue : $setting->svalue;
        }
        cache()->forever('settings', $settings);
    }
}
