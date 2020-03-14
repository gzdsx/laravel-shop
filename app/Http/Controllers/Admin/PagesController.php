<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\PagesRepositoryInterface;
use Illuminate\Http\Request;

class PagesController extends BaseController
{

    protected $pagesRepository;

    public function __construct(Request $request, PagesRepositoryInterface $pagesRepository)
    {
        parent::__construct($request);
        $this->pagesRepository = $pagesRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $catid = $request->get('catid', 0);
        $items = $this->pagesRepository->pages()->where($request->only('catid'))->orderBy('displayorder')->paginate();
        $pagination = $items->appends($request->except('page'))->render();
        $categories = $this->pagesRepository->categories()->all();
        return $this->view('admin.pages.pages', compact('catid', 'items', 'pagination', 'categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function batchUpdate(Request $request)
    {
        $delete = $request->post('delete', []);
        if ($delete) {
            $this->pagesRepository->whereKey($delete)->delete();
        }

        $pages = $request->input('pages', []);
        if ($pages) {
            foreach ($pages as $pageid => $page) {
                $this->pagesRepository->whereKey($pageid)->update($page);
            }
        }
        return $this->messager()->render();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newpage(Request $request)
    {
        $catid = $request->input('catid',0);
        $pageid = $request->get('pageid', 0);
        if ($pageid) {
            $page = $this->pagesRepository->findOrFail($pageid);
        } else {
            $page = $this->pagesRepository->make(compact('catid'));
        }
        $categories = $this->pagesRepository->categories()->all();
        return $this->view('admin.pages.newpage', compact('page', 'catid', 'pageid', 'categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function savePage(Request $request)
    {
        $pageid = $request->get('pageid', 0);
        $newpage = $request->post('newpage', []);
        if ($pageid) {
            $this->pagesRepository->whereKey($pageid)->update($newpage);
        } else {
            $newpage['type'] = 'page';
            $this->pagesRepository->create($newpage);
        }
        return $this->messager()->render();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function category()
    {
        $categories = $this->pagesRepository->categories()->orderBy('displayorder')->get();
        return $this->view('admin.pages.category', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveCategory(Request $request)
    {
        $delete = $request->post('delete');
        if ($delete) {
            foreach ($delete as $pageid) {
                $this->pagesRepository->whereKey($pageid)->orWhere('catid', $pageid)->delete();
            }
        }

        $categories = $request->post('categories');
        if ($categories) {
            foreach ($categories as $pageid => $category) {
                if ($category['title']) {
                    if ($pageid > 0) {
                        $this->pagesRepository->whereKey($pageid)->update($category);
                    } else {
                        $category['type'] = 'category';
                        $this->pagesRepository->create($category);
                    }
                }
            }
        }
        return $this->messager()->render();
    }
}
