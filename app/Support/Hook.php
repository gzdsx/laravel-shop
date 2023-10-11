<?php

namespace App\Support;

class Hook
{
    public $callbacks = [];

    public function add_filter($callback, $priority = 10)
    {
        $id = $this->build_unique_hook_id($callback);
        $priority_existed = isset($this->callbacks[$priority]);

        $this->callbacks[$priority][$id] = $callback;

        // If we're adding a new priority to the list, put them back in sorted order.
        if (!$priority_existed && count($this->callbacks) > 1) {
            ksort($this->callbacks, SORT_NUMERIC);
        }
    }

    public function apply_filters($value, ...$args)
    {
        foreach ($this->callbacks as $callbacks) {
            foreach ($callbacks as $callback) {
                $value = call_user_func($callback, $args);
            }
        }

        return $value;
    }

    /**
     * @param $callback
     * @param $priority
     * @return bool
     */
    public function remove_filter($callback, $priority)
    {
        $function_key = $this->build_unique_hook_id($callback);

        $exists = isset($this->callbacks[$priority][$function_key]);

        if ($exists) {
            unset($this->callbacks[$priority][$function_key]);

            if (!$this->callbacks[$priority]) {
                unset($this->callbacks[$priority]);
            }
        }

        return $exists;
    }

    /**
     * @param $callback
     * @return bool|int|string
     */
    public function has_filter($callback = false)
    {
        if (false === $callback) {
            return $this->has_filters();
        }

        $function_key = $this->build_unique_hook_id($callback);

        if (!$function_key) {
            return false;
        }

        foreach ($this->callbacks as $priority => $callbacks) {
            if (isset($callbacks[$function_key])) {
                return $priority;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function has_filters()
    {
        foreach ($this->callbacks as $callbacks) {
            if ($callbacks) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $priority
     * @return void
     */
    public function remove_all_filters($priority = false)
    {
        if (!$this->callbacks) {
            return;
        }

        if (false === $priority) {
            $this->callbacks = [];
        } elseif (isset($this->callbacks[$priority])) {
            unset($this->callbacks[$priority]);
        }
    }

    public function do_action(...$args)
    {
        foreach ($this->callbacks as $callbacks) {
            foreach ($callbacks as $callback) {
                call_user_func($callback, $args);
            }
        }
    }

    protected function build_unique_hook_id($callback)
    {
        if (is_string($callback)) {
            return $callback;
        }

        if (is_object($callback)) {
            // Closures are currently implemented as objects.
            $callback = [$callback, ''];
        } else {
            $callback = (array)$callback;
        }

        if (is_object($callback[0])) {
            // Object class calling.
            return spl_object_hash($callback[0]) . $callback[1];
        } elseif (is_string($callback[0])) {
            // Static calling.
            return $callback[0] . '::' . $callback[1];
        }

        return null;
    }
}