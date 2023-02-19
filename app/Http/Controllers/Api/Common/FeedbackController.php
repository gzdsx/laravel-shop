<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CommonFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $title = $request->input('title');
        $message = $request->input('message');

        $model = new CommonFeedback();
        $model->title = $title;
        $model->message = $message;
        $model->uid = Auth::id();
        $model->save();

        return jsonSuccess(['id' => $model->id]);
    }
}
