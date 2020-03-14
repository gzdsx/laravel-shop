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
 * Time: 15:25
 */

namespace App\Services;


use App\Repositories\Contracts\PostRepositoryInterface;
use App\Services\Contracts\PostServiceInterface;

class PostService implements PostServiceInterface
{
    protected $repository;

    public function __construct()
    {
        $this->repository = app(PostRepositoryInterface::class);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function find($id)
    {
        // TODO: Implement find() method.
        return $this->repository->with(['catlog', 'content', 'media', 'images'])->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes)
    {
        // TODO: Implement create() method.
        if (!$attributes['title']) {
            abort(400, trans('post.post title required'));
        }
        return $this->repository->create($attributes);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function update($id, array $attributes)
    {
        // TODO: Implement update() method.
        if (!$attributes['title']) {
            abort(400, trans('post.post title required'));
        }
        return $this->repository->whereKey($id)->update($attributes);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
        return $this->repository->whereKey($id)->delete();
    }

    /**
     * @param array $filter
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Pagination\Paginator
     */
    public function paginate(array $filter = [], $perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
    {
        // TODO: Implement paginate() method.
        return $this->repository->filter($filter)->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @param array $filter
     * @param int $count
     * @param int $offset
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function fetch(array $filter = [], $count = 10, $offset = 0)
    {
        // TODO: Implement fetch() method.
        return $this->repository->filter($filter)->offset($offset)->limit($count)->get();
    }

    /**
     * @param array $items
     * @param array $values
     * @return mixed
     */
    public function batchUpdate(array $items, array $values)
    {
        // TODO: Implement batchUpdate() method.
        return $this->repository->whereKey($items)->update($values);
    }

    /**
     * @param array $items
     * @return mixed
     */
    public function batchDelete(array $items)
    {
        // TODO: Implement batchDelete() method.
        return $this->repository->whereKey($items)->delete();
    }

    /**
     * @param \App\Models\PostItem $post
     * @param $content
     * @return mixed
     */
    public function updateContent($post, $content)
    {
        // TODO: Implement updateContent() method.
        if (is_string($content)) {
            return $post->content->update(['content' => $content]);
        }
        return $post->content->update($content);
    }

    /**
     * @param \App\Models\PostItem $post
     * @param array $images
     * @return mixed
     */
    public function updateImages($post, array $images)
    {
        // TODO: Implement updateImages() method.
        if ($images) {
            $displayorder = 0;
            $imageIds = $post->images->pluck('id');
            foreach ($images as $image) {
                if (!$post->image) $post->image = $image['thumb'];
                $imgid = $image['id'];
                $image['displayorder'] = $displayorder++;
                if ($imageIds->has($imgid)) {
                    $post->images()->where('id', $imgid)->update($image);
                    $imageIds->forget($imgid);
                } else {
                    $post->images()->create($image);
                }
            }
            $post->images()->whereIn('id', $imageIds)->delete();
        } else {
            $post->images()->delete();
        }
        $post->save();
        return $post;
    }

    /**
     * @param \App\Models\PostItem $post
     * @param array $media
     * @return mixed
     */
    public function updateMedia($post, array $media)
    {
        // TODO: Implement updateMedia() method.
        if ($post->media) {
            $post->media->update($media);
        } else {
            $post->media()->create($media);
        }
        return $post;
    }
}
