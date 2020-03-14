<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\AdminRequestException;
use App\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class WechatMaterialController extends BaseController
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AdminRequestException
     */
    public function material(Request $request)
    {
        $type = $request->get('type', 'image');
        $page = max(array(1, $request->input('page', 0)));
        try{
            $res = $this->officialAccount()->material->list($type, ($page - 1) * 20, 20);
            $totalCount = $res['total_count'];
            $paginator = new LengthAwarePaginator($res['item'], $totalCount, 20);
            return $this->view('admin.wechat.materials',[
                'type'=>$type,
                'items' => $res['item'],
                'pagination' => $paginator->setPath(admin_url('wechat/material'))->appends(['type'=>$type])->render()
            ]);
        }catch (\Exception $exception){
            throw new AdminRequestException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     *
     */
    public function addMaterial(Request $request)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function batchDelete(Request $request)
    {
        $items = $request->input('items');
        if (is_array($items)) {
            foreach ($items as $media_id) {
                $this->officialAccount()->material->delete($media_id);
            }
        }

        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AdminRequestException
     */
    public function news(Request $request)
    {

        $page = max(array(1, $request->input('page', 0)));
        try{
            $res = $this->officialAccount()->material->list('news', ($page - 1) * 20, 20);
            $totalCount = $res['total_count'];
            $paginator = new LengthAwarePaginator($res['item'], $totalCount, 20);
            return $this->view('admin.wechat.news',[
                'items' => $res['item'],
                'pagination' => $paginator->setPath(admin_url('wechat/news'))->render()
            ]);
        }catch (\Exception $exception){
            throw new AdminRequestException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     *
     */
    public function addNews()
    {

    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function viewImage(Request $request)
    {
        $media_id = $request->get('media_id');
        $content = $this->officialAccount()->material->get($media_id);
        return $content;
    }
}
