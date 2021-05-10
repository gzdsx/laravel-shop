<?php

namespace App\Http\Controllers\Admin\Live;

use App\Http\Controllers\Admin\BaseController;
use App\Models\LiveInvite;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InviteController extends BaseController
{
    /**
     * @return LiveInvite|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return LiveInvite::query();
    }

    public function batchget(Request $request)
    {
        $query = $this->repository()->with('user')->where('live_id', $request->input('live_id'));
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 15))->orderByDesc('id')->get()
        ]);
    }

    public function create(Request $request)
    {
        $live_id = $request->input('live_id');
        $invite = $this->repository()->create([
            'live_id' => $live_id,
            'code' => Uuid::uuid4()
        ]);

        return jsonSuccess(['invite' => $invite]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('items', []))->delete();
        return jsonSuccess();
    }

    public function code(Request $request, $id)
    {
        $invite = $this->repository()->find($id);
        return QrCode::format('png')->size(300)->generate($invite->link);
    }
}
