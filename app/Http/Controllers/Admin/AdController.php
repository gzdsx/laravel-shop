<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\AdRepositoryInterface;
use Illuminate\Http\Request;

class AdController extends BaseController
{
    protected $adRepository;

    public function __construct(Request $request, AdRepositoryInterface $adRepository)
    {
        parent::__construct($request);
        $this->adRepository = $adRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $items = $this->adRepository->orderByDesc('id')->paginate();
        return $this->view('admin.ad.ads', [
            'items' => $items,
            'pagination' => $items->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $items = $request->input('items', []);
        $this->adRepository->whereKey($items)->delete();
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchEnable(Request $request)
    {
        $items = $request->input('items', []);
        $this->adRepository->whereKey($items)->update(['available' => 1]);
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDisable(Request $request)
    {
        $items = $request->input('items', []);
        $this->adRepository->whereKey($items)->update(['available' => 0]);
        return ajaxReturn();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newad(Request $request)
    {
        $id = $request->input('id', 0);
        if ($id) {
            $ad = $this->adRepository->findOrFail($id);
        } else {
            $ad = $this->adRepository->make([]);
        }
        $addata[$ad->type] = $ad->data;
        return $this->view('admin.ad.newad', compact('id', 'ad', 'addata'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveAd(Request $request)
    {
        $id = $request->get('id', 0);
        $newad = $request->post('ad', []);
        $addata = $request->post('addata', []);
        if ($id) {
            $ad = $this->adRepository->findOrFail($id);
            $ad->fill($newad);
        } else {
            $ad = $this->adRepository->make($newad);
        }
        $ad->data = $addata[$newad['type']];
        $ad->save();
        return $this->messager()->setLinks([
            [trans('common.continue add'), admin_url('ad/newad')],
            [trans('common.back list'), admin_url('ad')]
        ])->render();
    }
}
