<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-17
 * Time: 22:58
 */

namespace App\Traits\Post;


use App\Models\PostItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait PostManageTrait
{

    use PostTrait;

    /**
     * @return PostItem|Builder
     */
    protected function query()
    {
        return PostItem::query()->withoutGlobalScopes();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $attributes = collect($request->input('post', []));
        if ($aid = $request->input('aid', 0)) {
            $post = $this->query()->findOrNew($aid);
        } else {
            $post = $this->query()->make();
        }
        $post->fill($attributes->except('aid')->all())->save();

        if ($attributes->has('content')) {
            $content = $attributes->get('content');
            if (is_array($content)) $content = $content['content'] ?? '';
            $post->content->update(['content' => $content]);
            if (!$post->summary) {
                $post->update(['summary' => mbsubstr(strip_html($content), 300)]);
            }
        }

        if ($attributes->has('images')) {
            $this->updateImages($post, $attributes->get('images'));
        }

        if ($attributes->has('media')) {
            $this->updateMedia($post, $attributes->get('media'));
        }

        return $this->sendSavedPostResponse($request, $post);
    }

    /**
     * @param \App\Models\PostItem $post
     * @param array $images
     */
    protected function updateImages(&$post, array $images)
    {
        $images = collect($images);
        $imageIds = $post->images->pluck('id', 'id');
        if ($images->count()) {
            $displayorder = 0;
            foreach ($images as $image) {
                $imgid = $image['id'] ?? 0;
                unset($image['id']);
                $image['displayorder'] = $displayorder++;
                if ($imageIds->has($imgid)) {
                    isset($image['thumb']) && $image['thumb'] = strip_image_url($image['thumb']);
                    isset($image['image']) && $image['image'] = strip_image_url($image['image']);
                    $post->images()->whereKey($imgid)->update($image);
                    $imageIds->forget($imgid);
                } else {
                    $post->images()->create($image);
                }
            }
        }
        $post->images()->whereKey($imageIds->keys())->delete();
    }

    /**
     * @param \App\Models\PostItem $post
     * @param array $attributes
     */
    protected function updateMedia(&$post, array $attributes)
    {
        // TODO: Implement updateMedia() method.
        if ($post->media) {
            $post->media->update($attributes);
        } else {
            $post->media()->create($attributes);
        }
    }


    /**
     * @param Request $request
     * @param $post
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSavedPostResponse(Request $request, $post)
    {
        return ajaxReturn(['post' => $post]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $items = $request->input('items', []);
        foreach ($this->query()->whereKey($items)->get() as $item) {
            $item->delete();
        }

        return $this->sendDeletedPostResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendDeletedPostResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $items = $request->input('items', []);
        $params = $request->input('params', []);
        $this->query()->whereKey($items)->update($params);
        return $this->sendBatchUpdatedPostResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchUpdatedPostResponse(Request $request)
    {
        return ajaxReturn();
    }
}
