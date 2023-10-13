<?php

use App\Models\PostItem;

function post_query()
{
    return PostItem::query();
}

