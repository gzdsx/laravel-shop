<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\ItemCatlogRepositoryInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Traits\Common\CatlogManagerTrait;
use Illuminate\Http\Request;

class ItemCatlogController extends BaseController
{
    use CatlogManagerTrait;

    /**
     * @return ItemCatlogRepositoryInterface
     */
    protected function catlogRepository()
    {
        return app(ItemCatlogRepositoryInterface::class)->withoutGlobalScopes();
    }

    protected function itemRepository()
    {
        return app(ItemRepositoryInterface::class)->withoutGlobalScopes();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->showCatlogs($request);
    }

    /**
     * @param Request $request
     * @param $catlogs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showCatlogsView(Request $request, $catlogs)
    {
        return $this->view('admin.item.catlog.catlogs', compact('catlogs'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function sendBatchUpdatedResponse(Request $request)
    {
        return $this->messager()->render();
    }

    /**
     * @param Request $request
     * @param $catlog
     * @param $catlogs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showCatlogForm(Request $request, $catlog, $catlogs)
    {
        return $this->view('admin.item.catlog.newcatlog', compact('catlog', 'catlogs'));
    }

    /**
     * @param Request $request
     * @param $catlog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function sendSavedResponse(Request $request, $catlog)
    {
        return $this->messager()->setLinks([
            [trans('common.back list'), admin_url('item/catlog')],
            [trans('common.reedit'), admin_url('item/catlog/newcatlog?catid=' . $catlog->catid)]
        ])->render();
    }

    /**
     * @param Request $request
     * @param $catlog
     * @param $catlogs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showDeleteForm(Request $request, $catlog, $catlogs)
    {
        return $this->view('admin.item.catlog.delete', compact('catlog', 'catlogs'));
    }

    /**
     * @param Request $request
     * @param $catid
     */
    protected function afterDeleted(Request $request, $catid)
    {

        $moveto = $request->input('moveto', 0);
        $deleteChilds = $request->input('deleteChilds', 0);

        if ($deleteChilds) {
            $catIds = $this->catlogRepository()->fetchAllIds($catid, false);
            $this->catlogRepository()->whereIn('catid', $catIds)->delete();
            $this->itemRepository()->whereIn('catid', $catIds)->delete();
        } else {
            if ($moveto) {
                $this->catlogRepository()->where('fid', $catid)->update(['fid' => $moveto]);
                $this->itemRepository()->where('catid', $catid)->update(['catid' => $moveto]);
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function sendDeletedResponse(Request $request)
    {
        return $this->messager()->setMessage(trans('sysmessage.info delete success'))
            ->setLinks([
                [trans('sysmessage.back_list'), admin_url('item/catlog')]
            ])->render();
    }

    /**
     * @param Request $request
     * @param $catlogs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showMergeForm(Request $request, $catlogs)
    {
        return $this->view('admin.post.catlog.merge', compact('catlogs'));
    }

    /**
     * @param Request $request
     * @param $source
     * @param $target
     */
    protected function afterMerged(Request $request, $source, $target)
    {
        $this->itemRepository()->whereKey($source)->update(['catid' => $target]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function sendMergedResponse(Request $request)
    {
        return $this->messager()->setMessage(trans('sysmessage.info update success'))
            ->setLinks([
                [trans('sysmessage.back_list'), admin_url('item/catlog')]
            ])->render();
    }
}
