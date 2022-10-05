<?php

namespace App\Http\Controllers\Admin\Trade;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Order;
use App\Traits\Trade\SoldTrait;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    use SoldTrait;

    /**
     * @return Order|\Illuminate\Database\Eloquent\Builder
     */
    protected function repository()
    {
        return Order::query();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids',[]))->get()->each->delete();
        return jsonSuccess();
    }
}
