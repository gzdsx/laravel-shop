<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\RefundReasonRepositoryInterface;
use Illuminate\Http\Request;

class RefundReasonController extends BaseController
{
    protected $refundReasonRepository;

    public function __construct(Request $request, RefundReasonRepositoryInterface $refundReasonRepository)
    {
        parent::__construct($request);
        $this->refundReasonRepository = $refundReasonRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->view('admin.common.refundreason', [
            'items' => $this->refundReasonRepository->orderBy('displayorder')->all()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $delete = $request->input('delete', []);
        if ($delete){
            $this->refundReasonRepository->whereKey($delete)->delete();
        }

        $items = $this->request->input('items');
        if ($items) {
            foreach ($items as $id => $item) {
                if ($id > 0) {
                    $this->refundReasonRepository->whereKey($id)->update($item);
                } else {
                    $this->refundReasonRepository->create($item);
                }
            }
        }

        return $this->messager()->render();
    }
}
