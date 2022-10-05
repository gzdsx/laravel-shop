<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2022 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2022/5/21
 * Time: 下午1:55
 */

namespace App\Models\Traits;


use App\Models\TalentCompany;
use App\Models\TalentJob;
use App\Models\TalentResume;
use App\Models\UserJobIntention;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait UserHasTalent
{


    /**
     * @return HasMany|TalentCompany
     */
    public function companies()
    {
        return $this->hasMany(TalentCompany::class, 'uid', 'uid');
    }

    /**
     * @return HasOne|TalentResume
     */
    public function resume()
    {
        return $this->hasOne(TalentResume::class, 'uid', 'uid');
    }

    /**
     * @return BelongsToMany|TalentJob
     */
    public function appliedJobs()
    {
        return $this->belongsToMany(
            TalentJob::class,
            'talent_job_apply',
            'applied_uid',
            'applied_job_id',
            'uid',
            'id'
        )->withTimeStamps();
    }

    /**
     * @return BelongsToMany|TalentJob
     */
    public function subscribedJobs()
    {
        return $this->belongsToMany(
            TalentJob::class,
            'talent_job_subscribe',
            'subscribed_uid',
            'subscribed_job_id',
            'uid',
            'id'
        )->withTimeStamps();
    }

    /**
     * @return HasMany|UserJobIntention
     */
    public function jobIntentions()
    {
        return $this->hasMany(UserJobIntention::class, 'uid', 'uid');
    }
}
