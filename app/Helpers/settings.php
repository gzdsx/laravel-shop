<?php

use App\Models\CommonSetting;

/**
 * @param $name
 * @param $default
 * @return \Illuminate\Contracts\Cache\Repository|mixed
 * @throws \Psr\Container\ContainerExceptionInterface
 * @throws \Psr\Container\NotFoundExceptionInterface
 * @throws \Psr\SimpleCache\InvalidArgumentException
 */
function settings($name = null, $default = null)
{
    static $_settings;
    if (!$_settings) {
        $_settings = collect(CommonSetting::settingsFromCache());
    }

    if (is_null($name)) {
        return $_settings;
    } else {
        return $_settings->get($name, $default);
    }
}

function update_setting($skey, $svalue)
{
    return CommonSetting::updateOrCreate(['skey' => $skey], ['svalue' => $svalue]);
}

function remove_setting($skey)
{
    CommonSetting::whereSkey($skey)->delete();
}