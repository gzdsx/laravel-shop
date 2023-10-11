<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminGroup
 *
 * @property int $gid 主键
 * @property string|null $name 名称
 * @property int $sort_num 序号
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AdminUser> $admins
 * @property-read int|null $admins_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminGroup whereSortNum($value)
 * @mixin \Eloquent
 */
class AdminGroup extends Model
{
    protected $table = 'admin_group';
    protected $primaryKey = 'gid';
    protected $fillable = ['gid', 'name', 'sort_num'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|AdminUser
     */
    public function admins()
    {
        return $this->hasMany(AdminUser::class, 'gid', 'gid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough|User
     */
    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            AdminUser::class,
            'gid',
            'uid',
            'gid',
            'uid'
        );
    }
}
