<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Express
 *
 * @property int $id 主键
 * @property string|null $name 快递名称
 * @property string|null $code 快递编码
 * @property string|null $regular 单号规则
 * @property int $displayorder 显示顺序
 * @method static \Illuminate\Database\Eloquent\Builder|Express newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Express newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Express query()
 * @method static \Illuminate\Database\Eloquent\Builder|Express whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Express whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Express whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Express whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Express whereRegular($value)
 * @mixin \Eloquent
 */
class Express extends Model
{
    protected $table = 'express';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'code', 'regular', 'displayorder'];

    public $timestamps = false;
}
