<?php

use App\Models\Page;

/**
 * @return Page|\Illuminate\Database\Eloquent\Builder
 */
function page(){
    return Page::query();
}