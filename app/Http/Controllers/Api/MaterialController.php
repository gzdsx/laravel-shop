<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Common\MaterialTrait;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    use MaterialTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $material = $this->query()
            ->where('uid', auth()->id())->findOrFail($request->input('id'));
        return ajaxReturn(['material' => $material]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->query()->where('uid',auth()->id())
            ->where('type',$request->input('type','image'));
        return ajaxReturn([
            'total'=>$query->count(),
            'items'=>$query->offset($request->input('offset',0))
                ->limit($request->input('count',10))->orderByDesc('id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request){
        $items = $this->query()->whereKey($request->input('items',[]))->get();
        foreach ($items as $item){
            $item->delete();
        }
        return ajaxReturn();
    }
}
