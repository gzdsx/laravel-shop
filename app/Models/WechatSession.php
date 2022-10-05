<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WechatSession
 *
 * @property int $id
 * @property string|null $openid
 * @property string|null $unionid
 * @property string|null $session_key
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession whereSessionKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatSession whereUnionid($value)
 * @mixin \Eloquent
 */
class WechatSession extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'wechat_session';
    protected $fillable = ['openid', 'unionid', 'session_key'];

    public $timestamps = false;
}
