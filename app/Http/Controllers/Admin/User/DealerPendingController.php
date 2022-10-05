<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Models\UserDealer;
use App\Models\UserDealerPending;
use App\Notifications\SystemMessage;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealerPendingController extends BaseController
{
    /**
     * @return UserDealerPending|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return UserDealerPending::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        $query = $this->repository();

        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($offset)->limit($count)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dispose(Request $request)
    {
        $action = $request->input('action', 'resolve');
        $ids = $request->input('ids', []);

        if ($action === 'resolve') {
            foreach ($this->repository()->whereKey($ids)->get() as $pending) {
                $dealer = UserDealer::firstOrNew(['uid' => Auth::id()]);
                $dealer->user()->associate($pending->uid);
                $dealer->save();

                $msg = new SystemMessage();
                $msg->title = '系统通知';
                $msg->message = '您的经销商资格已通过审核';
                $msg->from = [];

                $pending->user->notify(new SystemNotification($msg));

                $pending->delete();
            }
        }

        if ($action === 'reject') {
            foreach ($this->repository()->whereKey($ids)->get() as $pending) {
                $msg = new SystemMessage();
                $msg->title = '系统通知';
                $msg->message = '您的经销商资格未通过审核';
                $msg->from = [];

                $pending->user->notify(new SystemNotification($msg));

                $pending->delete();
            }
        }

        return jsonSuccess();
    }
}
