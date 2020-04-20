<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\PagesRepositoryInterface;
use Illuminate\Http\Request;

class PagesController extends BaseController
{

    /**
     * @return PagesRepositoryInterface|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function pagesRepository()
    {
        return app(PagesRepositoryInterface::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        return $this->view('admin.pages.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        if ($catid = $request->input('catid')) {
            $items = $this->pagesRepository()->pages()->where('catid', $catid)->get();
        } else {
            $items = $this->pagesRepository()->pages()->get();
        }

        return ajaxReturn(['items' => $items]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchgetCatlog()
    {
        $items = $this->pagesRepository()->categories()->get();
        return ajaxReturn(['items' => $items]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $pageid = $request->get('pageid', 0);
        $pages = $this->pagesRepository()->findOrNew($pageid);
        $pages->fill($request->input('pages', []))->save();
        return ajaxReturn(['pages' => $pages]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $this->pagesRepository()->whereKey($request->input('items', []))->delete();
        return ajaxReturn();
    }
}
