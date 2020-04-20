<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\SettingsRepositoryInterface;
use Illuminate\Http\Request;

class SettingsController extends BaseController
{
    protected $settingsRepository;

    public function __construct(Request $request, SettingsRepositoryInterface $settingsRepository)
    {
        parent::__construct($request);
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $settings = [];
        foreach ($this->settingsRepository->all() as $setting) {
            $svalue = json_decode($setting->svalue, true);
            $settings[$setting->skey] = is_array($svalue) ? $svalue : $setting->svalue;
        }
        return $this->view('admin.settings',compact('settings'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function store(Request $request)
    {
        foreach ($request->post('settings', []) as $skey => $svalue) {
            if (is_array($svalue)) $svalue = serialize($svalue);
            $this->settingsRepository->updateOrCreate(['skey' => $skey], ['svalue' => $svalue]);
        }

        $this->settingsRepository->updateCache();
        return $this->messager()->setAutoredirect(true)->render();
    }
}
