<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class UserRequestException extends Exception
{
    public $tips;
    public $link;

    public function __construct($message = "", $code = 400, $tips = '', $links = [], Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->tips = $tips;
        if ($links) {
            $this->links = $links;
        } else {
            $this->links = [
                [trans('common.go home'), admin_url('wellcome')],
                [trans('common.go back'), back()->getTargetUrl()]
            ];
        }
    }

    /**
     *
     */
    public function report()
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(Request $request)
    {
        if ($request->ajax() || $request->isJson()) {
            return ajaxError($this->getCode() ?: 400, $this->getMessage());
        } else {
            return view('errors.user', ['exception' => $this]);
        }
    }
}
