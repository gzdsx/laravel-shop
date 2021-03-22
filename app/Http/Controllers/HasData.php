<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/11
 * Time: 6:22 下午
 */

namespace App\Http\Controllers;


use App\Traits\Common\SysMessages;
use Illuminate\Contracts\Support\Arrayable;

trait HasData
{
    use SysMessages;

    protected $data = [];

    /**
     * @param array $data
     * @param bool $replace
     * @param string $prefix
     * @return $this
     */
    protected function assign($data = [], $replace = true, $prefix = '')
    {
        $array = $data instanceof Arrayable ? $data->toArray() : $data;
        foreach ($array as $key => $value) {
            if (is_string($key)) {
                if ($replace) {
                    $this->data[$key] = $value;
                } else {
                    if (!array_key_exists($key, $this->data)) {
                        $this->data[$prefix . $key] = $value;
                    } else {
                        $this->data[$key] = $value;
                    }
                }
            }
        }
        return $this;
    }

    /**
     * @param $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view($view, $data = [])
    {
        $this->assign($data);
        return view($view, $this->data);
    }
}
