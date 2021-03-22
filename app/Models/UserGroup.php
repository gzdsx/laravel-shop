<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\UserGroup
 *
 * @property int $gid
 * @property string|null $title
 * @property string|null $type
 * @property int $creditslower
 * @property int $creditshigher
 * @property array|null $privileges
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static Builder|UserGroup newModelQuery()
 * @method static Builder|UserGroup newQuery()
 * @method static Builder|UserGroup query()
 * @method static Builder|UserGroup systemGroups()
 * @method static Builder|UserGroup userGroups()
 * @method static Builder|UserGroup whereCreditshigher($value)
 * @method static Builder|UserGroup whereCreditslower($value)
 * @method static Builder|UserGroup whereGid($value)
 * @method static Builder|UserGroup wherePrivileges($value)
 * @method static Builder|UserGroup whereTitle($value)
 * @method static Builder|UserGroup whereType($value)
 * @mixin \Eloquent
 */
class UserGroup extends Model
{
    protected $table = 'user_group';
    protected $primaryKey = 'gid';
    protected $casts = [
        'privileges' => 'array'
    ];

    protected $fillable = ['gid','title','type','creditslower','creditshigher','privileges'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'uid', 'uid');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeUserGroups(Builder $query)
    {
        return $query->where('type', 'user');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeSystemGroups(Builder $query)
    {
        return $query->where('type', 'system');
    }
}
