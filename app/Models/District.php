<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\District
 *
 * @property int $id ID
 * @property int $fid 父级ID
 * @property string|null $name 名称
 * @property int $level 级别
 * @property int $usetype 使用类型
 * @property int $displayorder 排序
 * @property string|null $zone_code
 * @property float|null $lng
 * @property float|null $lat
 * @property string|null $pinyin
 * @property string|null $letter
 * @property string|null $citycode 区号
 * @property string|null $zipcode 邮编
 * @property-read \Illuminate\Database\Eloquent\Collection|District[] $childs
 * @property-read int|null $childs_count
 * @property-read District $parent
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCitycode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District wherePinyin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUsetype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereZipcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereZoneCode($value)
 * @mixin \Eloquent
 */
class District extends Model
{
    protected $table = 'district';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fid', 'name', 'level', 'usetype', 'displayorder',
        'zone_code', 'lng', 'lat', 'pinyin', 'letter', 'citycode', 'zipcode'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(District::class, 'fid', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->childs()->with('children');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(District::class, 'fid', 'id');
    }
}
