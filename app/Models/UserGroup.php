<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserGroup
 *
 * @property int $gid 主键
 * @property string|null $name 名称
 * @property int $credits 积分下限
 * @property string|null $memo 备注
 * @property array|null $privileges 权限
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static Builder|UserGroup newModelQuery()
 * @method static Builder|UserGroup newQuery()
 * @method static Builder|UserGroup query()
 * @method static Builder|UserGroup whereCredits($value)
 * @method static Builder|UserGroup whereGid($value)
 * @method static Builder|UserGroup whereMemo($value)
 * @method static Builder|UserGroup whereName($value)
 * @method static Builder|UserGroup wherePrivileges($value)
 * @mixin \Eloquent
 */
class UserGroup extends Model
{
    protected $table = 'user_group';
    protected $primaryKey = 'gid';
    protected $fillable = ['gid', 'name', 'credits', 'memo', 'privileges'];
    protected $casts = [
        'privileges' => 'array'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'uid', 'uid');
    }

    /**
     * @return UserGroup|Builder|Model|object|null
     */
    public function next()
    {
        return UserGroup::where('credits', '>', $this->credits)->orderBy('credits')->first();
    }

    /**
     * @return UserGroup|Builder|Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function prev()
    {
        return UserGroup::where('credits', '<', $this->credits)->orderByDesc('credits')->first();
    }
}
