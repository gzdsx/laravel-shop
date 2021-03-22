<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/9/11
 * Time: 下午6:43
 */

namespace App\Traits\Common;


class SysMessager
{
    const MSGTYPE_SUCCESS = 'success';
    const MSGTYPE_INFOMATION = 'infomation';
    const MSGTYPE_ERROR = 'error';
    const MSGTYPE_WARNING = 'warning';

    protected $data = [
        'message' => '',
        'type' => 'success',
        'redirectTo' => '',
        'links' => [],
        'tips' => '',
        'autoredirect' => false,
        'timeout' => 5,
    ];
    public $view = 'common.message';

    public function __construct()
    {
        $this->setMessage(trans('sysmessage.info save success'));
        $this->setRedirectTo(back()->getTargetUrl());
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->data['message'] = $message;
        return $this;
    }

    /**
     * @param $redirectTo
     * @return $this
     */
    public function setRedirectTo($redirectTo)
    {
        $this->data['redirectTo'] = url($redirectTo);
        return $this;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->data['type'] = $type;
        return $this;
    }

    /**
     * @param array $links
     * @return $this
     */
    public function setLinks(array $links)
    {
        $this->data['links'] = $links;
        return $this;
    }

    /**
     * @param $tips
     * @return $this
     */
    public function setTips($tips)
    {
        $this->data['tips'] = $tips;
        return $this;
    }


    /**
     * @param bool $autoredirect
     * @return $this
     */
    public function setAutoredirect($autoredirect = true)
    {
        $this->data['autoredirect'] = $autoredirect;
        return $this;
    }


    /**
     * @param $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->data['timeout'] = $timeout;
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function appends($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (!isset($this->data[$key])) {
                    $this->data[$key] = $value;
                }
            }
        }

        return $this;
    }

    /**
     * @param $view
     * @return $this
     */
    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @param string|null $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render($view = null, $data = [])
    {
        if ($view) $this->view = $view;
        if (!empty($data)) {
            $this->appends($data);
        }

        if (!$this->data['tips']) {
            if ($this->data['autoredirect']) {
                $this->setTips(trans('sysmessage.auto_redirect_tips', ['timeout' => $this->data['timeout']]));
            } else {
                $this->setTips(trans('sysmessage.default_tips'));
            }
        }
        return view($this->view, $this->data);
    }
}
