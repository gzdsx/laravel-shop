<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class AdminRequestException extends Exception
{
    public $links;

    public function __construct($message = "", $code = 400, array $links = [], Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function render(Request $request)
    {
        if ($request->ajax()) {
            return ajaxError($this->getCode() ?: 400, $this->getMessage());
        } else {
            return view('errors.admin', ['exception' => $this]);
        }
    }
}
