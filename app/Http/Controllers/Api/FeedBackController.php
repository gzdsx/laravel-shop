<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiRequestException;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedBackController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiRequestException
     */
    public function save(Request $request){
        $title = $request->input('title');
        $message = $request->input('message');

        if ($title && $message) {
            $feedback = Feedback::create([
                'uid'=>$this->uid,
                'username'=>$this->username,
                'title'=>$title,
                'message'=>$message
            ]);

            return ajaxReturn(['feedback'=>$feedback]);
        }else{
            throw new ApiRequestException(trans('sysmessage.invalid parameter'), 403);
        }
    }
}
