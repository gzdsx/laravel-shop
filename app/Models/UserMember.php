<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserMember
 *
 * @property int $id 主键
 * @property string|null $title 会员名称
 * @property int $level 会员级别
 * @property string $icon 会员图标
 * @property string|null $remark 备注
 * @property int $creditslower 积分下限
 * @property float $discount 折扣比例
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static Builder|UserMember newModelQuery()
 * @method static Builder|UserMember newQuery()
 * @method static Builder|UserMember query()
 * @method static Builder|UserMember whereCreditslower($value)
 * @method static Builder|UserMember whereDiscount($value)
 * @method static Builder|UserMember whereIcon($value)
 * @method static Builder|UserMember whereId($value)
 * @method static Builder|UserMember whereLevel($value)
 * @method static Builder|UserMember whereRemark($value)
 * @method static Builder|UserMember whereTitle($value)
 * @mixin \Eloquent
 */
class UserMember extends Model
{
    protected $table = 'user_member';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'level', 'icon', 'remark', 'creditslower', 'discount'];
    public $timestamps = false;

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope('sort', function (Builder $builder) {
            return $builder->orderBy('level')->orderBy('id');
        });
    }

    /**
     * @param $value
     * @return string
     */
    public function getIconAttribute($value)
    {
        return $value ? image_url($value) : $value;
    }

    /**
     * @param $value
     */
    public function setIconAttribute($value)
    {
        $this->attributes['icon'] = strip_image_url($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'level', 'level');
    }

    /**
     * @return Builder|Model|object|UserMember|null
     */
    public function prev()
    {
        return UserMember::withoutGlobalScopes()->where('level', '<', $this->level)->orderByDesc('leve')->first();
    }

    /**
     * @return Builder|Model|object|UserMember|null
     */
    public function next()
    {
        return UserMember::withoutGlobalScopes()->where('level', '>', $this->level)->orderBy('level')->first();
    }
}