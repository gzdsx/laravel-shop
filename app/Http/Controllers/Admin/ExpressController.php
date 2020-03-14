<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\ExpressRepositoryInterface;
use Illuminate\Http\Request;

class ExpressController extends BaseController
{
    protected $expressRepository;

    public function __construct(Request $request, ExpressRepositoryInterface $expressRepository)
    {
        parent::__construct($request);
        $this->expressRepository = $expressRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        return $this->view('admin.common.express', [
            'items' => $this->expressRepository->all()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $delete = $request->input('delete', []);
        if ($delete) $this->expressRepository->whereKey($delete)->delete();

        $items = $this->request->input('items', []);
        foreach ($items as $id => $item) {
            if ($item['name']) {
                if ($id > 0) {
                    $this->expressRepository->whereKey($id)->update($item);
                } else {
                    $this->expressRepository->create($item);
                }
            }
        }
        return $this->messager()->render();
    }
}
