<?php

namespace App\Models;

use App\Models\Traits\UserCmsRelations;
use App\Models\Traits\WechatMessageAble;
use EloquentFilter\Filterable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


/**
 * App\Models\User
 *
 * @property int $uid
 * @property int $gid 管理权限
 * @property int $admincp 是否允许登录后台
 * @property string|null $username 用户名
 * @property string|null $email 邮箱
 * @property string|null $mobile 手机号
 * @property string|null $password 密码
 * @property string|null $remember_token
 * @property int $state 状态
 * @property int $newpm 新消息
 * @property int $email_state 邮箱验证状态
 * @property int $avatar_state 头像验证状态
 * @property int $auth_state 头像验证状态
 * @property int $freeze 冻结账户
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\Account|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\UserAuth|null $auth
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $boughts
 * @property-read int|null $boughts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostItem[] $collectedPosts
 * @property-read int|null $collected_posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserConnect[] $connects
 * @property-read int|null $connects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscribe[] $fans
 * @property-read int|null $fans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserField[] $fields
 * @property-read int|null $fields_count
 * @property-read string|null $avatar
 * @property-read mixed $state_des
 * @property-read \App\Models\UserGroup $group
 * @property-read \App\Models\UserInfo|null $info
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Material[] $materials
 * @property-read int|null $materials_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostCollect[] $postCollects
 * @property-read int|null $post_collects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostItem[] $posts
 * @property-read int|null $posts_count
 * @property-read \App\Models\UserStat|null $stat
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscribe[] $subscribes
 * @property-read int|null $subscribes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User filter($input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAdmincp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAuthState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatarState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBeginsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEndsWith($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFreeze($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLike($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNewpm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens, WechatMessageAble;
    use UserCmsRelations, Filterable;

    protected $table = 'user';
    protected $primaryKey = 'uid';
    protected $hidden = [
        'password', 'remember_token'
    ];
    protected $fillable = [
        'uid', 'gid', 'admincp', 'username', 'email', 'mobile',
        'password', 'remember_token', 'state', 'newpm', 'email_state',
        'avatar_state', 'auth_state', 'freeze', 'exp', 'exp1', 'exp2', 'exp3'
    ];

    protected $appends = [
        'avatar',
        'state_des'
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (User $user) {
            if (!$user->gid) {
                $user->gid = UserGroup::userGroups()->orderBy('creditslower')->first()->gid;
            }
        });

        static::created(function (User $user) {
            $user->info()->create();
            $user->stat()->create();
            $user->auth()->create();
            $user->account()->create();
        });

        static::deleted(function (User $user) {
            $user->info()->delete();
            $user->logs()->delete();
            $user->stat()->delete();
            $user->fields()->delete();
            $user->connects()->delete();
            $user->account()->delete();
        });
    }

    /**
     * @return string|null
     */
    public function getAvatarAttribute()
    {
        if (isset($this->attributes['uid'])) {
            return avatar($this->attributes['uid']);
        }
        return null;
    }

    public function getStateDesAttribute(){
        return is_null($this->state) ? null : null;
    }

    /**
     * Find the user instance for the given username.
     * @param $username
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findForPassport($username)
    {
        $user = $this->where('mobile', $username)->first();
        if ($user) {
            return $user;
        }

        $user = $this->where('email', $username)->first();
        if ($user) {
            return $user;
        }

        return $this->where('username', $username)->first();
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->admincp == 1;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function connects()
    {
        return $this->hasMany(UserConnect::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields()
    {
        return $this->hasMany(UserField::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(UserGroup::class, 'gid', 'gid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info()
    {
        return $this->hasOne(UserInfo::class, 'uid', 'uid');
    }

    public function auth()
    {
        return $this->hasOne(UserAuth::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(UserLog::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stat()
    {
        return $this->hasOne(UserStat::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        return $this->hasOne(Account::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materials()
    {
        return $this->hasMany(Material::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fans()
    {
        return $this->hasMany(Subscribe::class, 'subscribe_uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boughts()
    {
        return $this->hasMany(Order::class, 'buyer_uid', 'uid');
    }
}
