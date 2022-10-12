<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\CommonExpress
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property string|null $regular
 * @property int $sort_num
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress whereRegular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonExpress whereSortNum($value)
 * @mixin \Eloquent
 */
class CommonExpress extends Model
{
    protected $table = 'common_express';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'code', 'regular', 'displayorder'];

    public $timestamps = false;
}
