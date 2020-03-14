<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\LinkRepositoryInterface;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    protected $linkRepository;

    public function __construct(Request $request, LinkRepositoryInterface $linkRepository)
    {
        parent::__construct($request);
        $this->linkRepository = $linkRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {

        return $this->view('admin.common.link', [
            'categories' => $this->linkRepository->getCategories()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $delete = $request->post('delete', []);
        if ($delete) {
            $this->linkRepository->whereKey($delete)->delete();
        }

        $items = $request->post('items', []);
        foreach ($items as $id => $item) {
            if ($item['title']) {
                if ($id > 0) {
                    $this->linkRepository->whereKey($id)->update($item);
                } else {
                    $this->linkRepository->create($item);
                }
            }
        }
        return $this->messager()->setMessage(trans('sysmessage.info save success'))->render();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function setimage(Request $request)
    {
        $id = $request->input('id');
        $image = $request->input('image');
        if ($id && $image) {
            $this->linkRepository->whereKey($id)->update(compact('image'));
        }
        return ajaxReturn();
    }
}
