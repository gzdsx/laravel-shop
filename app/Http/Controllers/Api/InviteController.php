<?php

namespace App\Http\Controllers\Api;

use App\Models\Invite;
use Illuminate\Http\Request;

class InviteController extends BaseController
{
    public function bind(Request $request)
    {
        $uid = $request->input('uid');
        $invitee_uid = $request->input('invitee_uid');
        if ($uid && $invitee_uid) {
            return Invite::updateOrCreate(['uid' => $uid, 'invitee_uid' => $invitee_uid]);
        }
        return ajaxReturn();
    }
}
