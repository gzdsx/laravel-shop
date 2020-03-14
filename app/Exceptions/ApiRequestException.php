<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class ApiRequestException extends Exception
{
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
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
        if (config('app.debug')) {
            return ajaxError($this->getCode() ?: 400, $this->getMessage(), [
                'file' => $this->getFile(),
                'line' => $this->getLine(),
                'trace' => $this->getTrace()
            ]);
        }
        return ajaxError($this->getCode() ?: 400, $this->getMessage());
    }
}
