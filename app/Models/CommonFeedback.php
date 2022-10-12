<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\CommonFeedback
 *
 * @property int $id
 * @property int $uid
 * @property string|null $username
 * @property string|null $title
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommonFeedback whereUsername($value)
 * @mixin \Eloquent
 */
class CommonFeedback extends Model
{
    protected $table = 'common_feedback';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'username', 'title', 'message'];
}
