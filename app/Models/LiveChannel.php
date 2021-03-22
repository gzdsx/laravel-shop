<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LiveChannel
 *
 * @property int $channel_id
 * @property string|null $name
 * @property int $displayorder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Live[] $lives
 * @property-read int|null $lives_count
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel query()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveChannel whereName($value)
 * @mixin \Eloquent
 */
class LiveChannel extends Model
{
    protected $table = 'live_channel';
    protected $primaryKey = 'channel_id';
    protected $fillable = ['name', 'displayorder'];
    public $timestamps = false;

    public function lives()
    {
        return $this->hasMany(Live::class, 'channel_id', 'channel_id');
    }
}
