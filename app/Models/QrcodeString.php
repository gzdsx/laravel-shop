<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QrcodeString
 *
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrcodeString newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrcodeString newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrcodeString query()
 * @mixin \Eloquent
 */
class QrcodeString extends Model
{
    protected $table = 'qrcode_string';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $dateFormat = 'U';
    protected $casts = [
        'created_at'=>'datetime:Y-m-d H:i:s',
    ];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($model){
            if (!$model->created_at) $model->created_at = time();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'uid');
    }
}
