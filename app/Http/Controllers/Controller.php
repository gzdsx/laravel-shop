<?php

namespace App\Http\Controllers;

use App\Traits\Common\AuthenticatedUser;
use App\Traits\Common\SysMessages;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use SysMessages, AuthenticatedUser;

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
