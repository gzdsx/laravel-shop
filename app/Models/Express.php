<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Express
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property string|null $regular
 * @property int $displayorder
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Express whereRegular($value)
 * @mixin \Eloquent
 */
class Express extends Model
{
    protected $table = 'express';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'code', 'regular', 'displayorder'];

    public $timestamps = false;

    /**
     * @param $value
     */
    public function setDisplayorderAttribute($value)
    {
        $this->attributes['displayorder'] = intval($value);
    }
}
