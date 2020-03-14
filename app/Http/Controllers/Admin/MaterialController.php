<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\MaterialRepositoryInterface;
use Illuminate\Http\Request;

class MaterialController extends BaseController
{
    protected $materialRepository;

    public function __construct(Request $request, MaterialRepositoryInterface $materialRepository)
    {
        parent::__construct($request);
        $this->materialRepository = $materialRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if (!$request->has('type')) {
            $request->query->add(['type' => 'image']);
        }
        $items = $this->materialRepository->with(['user'])->filter($request->all())->orderByDesc('id')->paginate();
        return $this->view('admin.common.material', [
            'items' => $items,
            'pagination' => $items->appends($request->except('page'))->render(),
            'type' => $request->input('type'),
            'uid' => $request->input('uid'),
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'time_begin' => $request->input('time_begin'),
            'time_end' => $request->input('time_end')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $items = $request->input('items', []);
        $this->materialRepository->whereKey($items)->delete();
        return ajaxReturn();
    }
}
