<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        $settings = [];
        foreach (Settings::all() as $setting) {
            $svalue = json_decode($setting->svalue, true);
            $settings[$setting->skey] = is_array($svalue) ? $svalue : $setting->svalue;
        }
        return jsonSuccess(['settings'=>$settings]);
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
            Settings::updateOrInsert(['skey'=>$skey], ['svalue' => $svalue]);
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
        foreach (Settings::all() as $setting) {
            $svalue = json_decode($setting->svalue, true);
            $settings[$setting->skey] = is_array($svalue) ? $svalue : $setting->svalue;
        }
        cache()->forever('settings', $settings);
    }
}
