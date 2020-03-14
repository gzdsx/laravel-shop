<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Settings
 *
 * @property string $skey 标识
 * @property string|null $svalue 值
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereSkey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereSvalue($value)
 * @mixin \Eloquent
 */
class Settings extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'skey';
    protected $keyType = 'string';
    protected $fillable = ['skey', 'svalue'];

    public $timestamps = false;
    public $incrementing = false;
}
