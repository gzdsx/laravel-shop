<?php

namespace App\Models;

use App\Jobs\ClearUserData;
use App\Models\Traits\HasDates;
use App\Models\Traits\UserHasOrders;
use App\Models\Traits\UserHasPosts;
use App\Models\Traits\UserHasCarts;
use App\Models\Traits\UserHasProducts;
use EloquentFilter\Filterable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


/**
 * App\Models\User
 *
 * @property int $uid 主键
 * @property int $gid 管理权限
 * @property int $admincp 是否允许登录后台
 * @property string|null $username 会员名
 * @property string|null $email 邮箱
 * @property string|null $mobile 手机号
 * @property string|null $password 密码
 * @property string|null $remember_token token
 * @property string|null $avatar 头像
 * @property int $level 会员等级
 * @property int $state 状态
 * @property int $email_state 邮箱验证状态
 * @property int $avatar_state 头像验证状态
 * @property int $auth_state 实名认证状态
 * @property int $freeze 冻结账户
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \App\Models\UserAccount|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserAddress[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\UserAuth|null $auth
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $boughts
 * @property-read int|null $boughts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BuyLog[] $buyLogs
 * @property-read int|null $buy_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cart[] $carts
 * @property-read int|null $carts_count
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
 * @property-read array|string|null $state_des
 * @property-read \App\Models\UserGroup $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Material[] $materials
 * @property-read int|null $materials_count
 * @property-read \App\Models\UserMember $member
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostCollect[] $postCollects
 * @property-read int|null $post_collects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostItem[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCollect[] $productCollects
 * @property-read int|null $product_collects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductItem[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\UserProfile|null $profile
 * @property-read \App\Models\UserStat|null $stat
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscribe[] $subscribes
 * @property-read int|null $subscribes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdmincp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAuthState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatarState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFreeze($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, Filterable, HasApiTokens, HasDates;
    use UserHasPosts, UserHasCarts, UserHasProducts, UserHasOrders;

    protected $table = 'user';
    protected $primaryKey = 'uid';
    protected $hidden = [
        'password', 'remember_token', 'admincp'
    ];
    protected $fillable = [
        'uid', 'gid', 'admincp', 'username', 'email', 'mobile', 'password', 'remember_token',
        'avatar', 'state', 'email_state', 'avatar_state', 'auth_state', 'freeze'
    ];

    protected $appends = [
        'state_des'
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function (User $user) {
            if (!$user->gid) {
                if ($group = UserGroup::userGroups()->orderBy('creditslower')->first()) {
                    $user->gid = $group->gid;
                }
            }
        });

        static::created(function (User $user) {
            $user->profile()->create();
            $user->stat()->create();
            $user->auth()->create();
            $user->account()->create();
        });

        static::deleting(function (User $user) {
            $user->profile()->delete();
            $user->stat()->delete();
            $user->auth()->delete();
            $user->account()->delete();
            $user->fields()->delete();
            $user->connects()->delete();
            $user->logs()->delete();
            $user->addresses()->delete();
            $user->notifications()->delete();
            $user->buyLogs()->delete();
            $user->transactions()->delete();

            dispatch(new ClearUserData($user));
        });
    }

    /**
     * @return string|null
     */
    public function getAvatarAttribute($value)
    {
        return $value ? image_url($value) : asset('images/common/avatar_default.png');
    }

    /**
     * @param $value
     */
    public function setAvatarAttribute($value)
    {
        $this->attributes['avatar'] = strip_image_url($value);
    }

    /**
     * @return array|string|null
     */
    public function getStateDesAttribute()
    {
        return is_null($this->state) ? null : trans('user.user_states.' . $this->state);
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(UserMember::class, 'level', 'level');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'uid', 'uid');
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
        return $this->hasOne(UserAccount::class, 'uid', 'uid');
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
        return $this->hasMany(UserAddress::class, 'uid', 'uid');
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
    public function buyLogs()
    {
        return $this->hasMany(BuyLog::class, 'uid', 'uid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function transactions()
    {
        return Transaction::where('payer_id', $this->uid)->orWhere('payee_id', $this->uid);
    }
}
