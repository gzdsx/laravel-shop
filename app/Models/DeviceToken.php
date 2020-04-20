<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\DeviceToken
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceToken query()
 * @mixin \Eloquent
 */
class DeviceToken extends Model
{
    protected $table = 'device_token';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'device_token'];

    public $timestamps = false;
}
