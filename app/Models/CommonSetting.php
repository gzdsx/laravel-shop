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
}
