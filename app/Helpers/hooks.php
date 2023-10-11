<?php

use App\Support\Hook;

/**
 * @param $hook_name
 * @param $callback
 * @param $priority
 * @return void
 */
function add_filter($hook_name, $callback, $priority = 10)
{
    global $_hooks;

    if (!isset($_hooks[$hook_name])) {
        $_hooks[$hook_name] = new Hook();
    }

    $_hooks[$hook_name]->add_filter($callback, $priority);
}

/**
 * @param $hook_name
 * @param $value
 * @param ...$args
 * @return mixed
 */
function apply_filters($hook_name, $value, ...$args)
{
    global $_hooks;

    if (!isset($_hooks[$hook_name])) {
        return $value;
    }

    return $_hooks[$hook_name]->apply_filters($value, $args);
}

/**
 * @param $hook_name
 * @param $callback
 * @param $priority
 * @return void
 */
function add_action($hook_name, $callback, $priority = 10)
{
    add_filter($hook_name, $callback, $priority);
}

/**
 * @param $hook_name
 * @param ...$args
 * @return void
 */
function do_action($hook_name, ...$args)
{
    global $_hooks;

    if (isset($_hooks[$hook_name])) {
        $_hooks[$hook_name]->do_action($args);
    }
}