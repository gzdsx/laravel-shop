<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\CommonSetting
 *
 * @property string $skey 标识
 * @property string|null $svalue 值
 * @method static \Illuminate\Database\Eloquent\Builder|CommonSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonSetting whereSkey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonSetting whereSvalue($value)
 * @mixin \Eloquent
 */
class CommonSetting extends Model
{
    protected $table = 'common_setting';
    protected $primaryKey = 'skey';
    protected $keyType = 'string';
    protected $fillable = ['skey', 'svalue'];

    public $timestamps = false;
    public $incrementing = false;

    /**
     * @return void
     * @throws \Exception
     */
    public static function updateCache()
    {
        $settings = [];
        foreach (CommonSetting::all() as $setting) {
            $svalue = json_decode($setting->svalue, true);
            $settings[$setting->skey] = is_array($svalue) ? $svalue : $setting->svalue;
        }
        cache()->forever('settings', $settings);
    }

    /**
     * @return \Illuminate\Contracts\Cache\Repository|mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function settingsFromCache()
    {
        $settings = cache()->get('settings');
        if (is_null($settings)) {
            CommonSetting::updateCache();
            return cache()->get('settings');
        }

        return $settings;
    }
}
