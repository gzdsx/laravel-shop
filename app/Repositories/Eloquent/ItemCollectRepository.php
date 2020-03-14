<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-23
 * Time: 09:57
 */

namespace App\Repositories\Eloquent;


use App\Models\ItemCollect;
use App\Repositories\Contracts\ItemCollectRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ItemCollectRepository extends BaseRepository implements ItemCollectRepositoryInterface
{
    public function model()
    {
        // TODO: Implement getModel() method.
        return ItemCollect::class;
    }

    /**
     * @param $itemid
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function addCollect($itemid)
    {
        // TODO: Implement addCollect() method.
        return $this->firstOrCreate(['uid'=>Auth::id()], ['itemid'=>$itemid]);
    }
}
