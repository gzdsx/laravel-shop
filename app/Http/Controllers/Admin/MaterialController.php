<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\MaterialRepositoryInterface;
use Illuminate\Http\Request;

class MaterialController extends BaseController
{

    /**
     * @return MaterialRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function materialRepository(){
        return app(MaterialRepositoryInterface::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        return $this->view('admin.material');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request){
        $type = $request->input('type','image');
        $result = $this->materialRepository()->with('user')
            ->where('type',$type)->filter($request->except('type'))->paginate();
        return ajaxReturn([
            'items'=>$result->items(),
            'total'=>$result->total(),
            'per_page'=>$result->perPage(),
            'current_page' => $result->currentPage()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $items = $request->input('items', []);
        $this->materialRepository()->whereKey($items)->delete();
        return ajaxReturn();
    }
}
