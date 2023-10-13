<?php

use App\Models\Category;

function get_category($cate)
{
    return Category::find($cate);
}

function get_categories($options = [])
{
    return Category::filter($options)->get();
}