<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\WeChat\WechatDefaultConfig;
use Illuminate\Http\Request;

class WechatMaterialController extends BaseController
{
    use WechatDefaultConfig;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(Request $request)
    {
        return jsonSuccess(['material' => $this->officialAccount()->material->get($request->input('media_id'))]);
    }

    /**
     * @param Request $request
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function batchget(Request $request)
    {
        if ($request->input('type') == 'news') {
            $items = [];
            $result = $this->officialAccount()->material->list(
                $request->input('type', 'image'),
                $request->input('offset', 0), 15);

            foreach ($result['item'] as $item) {
                $items[] = [
                    'media_id' => $item['media_id'],
                    'name' => $item['content']['news_item'][0]['title'],
                    'thumb_media_id' => $item['content']['news_item'][0]['thumb_media_id'],
                    'url' => $item['content']['news_item'][0]['url'],
                    'create_time' => date('Y-m-d H:i:s', $item['content']['create_time']),
                ];
            }
            return jsonSuccess([
                'total' => $result['total_count'],
                'items' => $items
            ]);
        } else {
            $result = $this->officialAccount()->material->list(
                $request->input('type', 'image'),
                $request->input('offset', 0), 15);
            return jsonSuccess([
                'total' => $result['total_count'],
                'items' => $result['item']
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(Request $request)
    {
        foreach ($request->input('items', []) as $item) {
            $this->officialAccount()->material->delete($item);
        }
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function viewImage(Request $request)
    {
        return $this->officialAccount()->material->get($request->input('media_id'));
    }
}
