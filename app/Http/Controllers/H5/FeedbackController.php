<?php

namespace App\Http\Controllers\H5;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->view('h5.feedback');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $message = $request->input('message');

        Feedback::create([
            'uid' => Auth::id(),
            'title' => $title,
            'message' => $message
        ]);

        return ajaxReturn();
    }
}
