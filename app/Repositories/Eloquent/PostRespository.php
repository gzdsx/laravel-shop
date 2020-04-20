<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2019 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2019-06-21
 * Time: 15:16
 */

namespace App\Repositories\Eloquent;


use App\Models\PostItem;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRespository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * @return PostItem|\Illuminate\Database\Eloquent\Builder|mixed
     */
    public function query()
    {
        // TODO: Implement query() method.
        return PostItem::query();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|string
     */
    public function model()
    {
        // TODO: Implement getModel() method.
        return PostItem::class;
    }

    /**
     * @param $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function find($id, $columns = ['*'])
    {
        return $this->query()->with(['catlog', 'content', 'media', 'images', 'user'])->findOrFail($id, $columns);
    }

    /**
     * @param array $attributes
     * @return PostItem|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes)
    {
        // TODO: Implement store() method.
        $attributes = collect($attributes);
        if ($attributes->has('aid')) {
            $post = $this->query()->findOrNew($attributes->get('aid'));
        } else {
            $post = $this->query()->make();
        }
        $attributes->forget('aid');
        $post->fill($attributes->all())->save();

        if ($attributes->has('content')) {
            $content = $attributes->get('content');
            if (is_array($content)) $content = $content['content'] ?? '';
            $post->content->update(['content' => $content]);
            if ($attributes->has('summary')) {
                $post->update(['summary' => mbsubstr(strip_html($content), 300)]);
            }
        }

        if ($attributes->has('images')) {
            $this->updateImages($post, $attributes->get('images'));
        }

        if ($attributes->has('media')) {
            $this->updateMedia($post, $attributes->get('media'));
        }

        return $post;
    }

    /**
     * @param \App\Models\PostItem $post
     * @param array $images
     */
    protected function updateImages($post, array $images)
    {
        // TODO: Implement updateImages() method.
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
    protected function updateMedia($post, array $attributes)
    {
        // TODO: Implement updateMedia() method.
        if ($post->media) {
            $post->media->update($attributes);
        } else {
            $post->media()->create($attributes);
        }
    }
}
