<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WxLogin
 *
 * @property int $id
 * @property int $uid
 * @property string|null $basestr
 * @property string|null $openid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin query()
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereBasestr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WechatLogin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WechatLogin extends Model
{
    protected $table = 'wechat_login';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'basestr', 'openid'];
}
