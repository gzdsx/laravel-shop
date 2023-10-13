<?php

use App\Models\CommonBlock;
use App\Models\CommonBlockItem;

function block()
{
    return CommonBlock::query();
}

/**
 * @param $block_id
 * @return CommonBlockItem[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
 */
function get_block_items($block_id)
{
    return CommonBlockItem::whereBlockId($block_id)->get();
}