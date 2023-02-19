<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\CommonFeedback
 *
 * @property int $id 主键
 * @property int $uid 管理用户
 * @property string|null $title 标题
 * @property string|null $message 内容
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CommonFeedback extends Model
{
    protected $table = 'common_feedback';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'title', 'message'];
}
