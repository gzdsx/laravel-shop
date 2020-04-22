<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WechatMenu
 *
 * @property int $id
 * @property int $fid
 * @property string|null $name
 * @property string|null $type
 * @property string|null $key
 * @property string|null $media_id
 * @property string|null $url
 * @property string|null $appid
 * @property string|null $pagepath
 * @property int $displayorder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WechatMenu[] $children
 * @property-read int|null $children_count
 * @property-read array|\Illuminate\Contracts\Translation\Translator|string|null $type_des
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereAppid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereDisplayorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu wherePagepath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereUrl($value)
 * @mixin \Eloquent
 */
class WechatMenu extends Model
{
    protected $table = 'wechat_menu';
    protected $primaryKey = 'id';
    protected $fillable = ['fid', 'name', 'type', 'key', 'media_id', 'url', 'appid', 'pagepath', 'displayorder'];
    protected $appends = ['type_des'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(WechatMenu::class, 'fid', 'id');
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getTypeDesAttribute()
    {
        if ($this->attributes['type']) {
            return trans('wechat.menu_types.' . $this->attributes['type']);
        }
        return null;
    }
}
