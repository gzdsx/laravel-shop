<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2020 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2020/4/24
 * Time: 2:13 上午
 */

namespace App\Traits\Post;


use App\Models\PostItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait PostTrait
{
    /**
     * @return Builder
     */
    protected function repository()
    {
        return PostItem::withGlobalScope('available', function (Builder $builder) {
            return $builder->where('state', 1);
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $post = $this->repository()->findOrFail($request->input('aid'));
        $post->load(['user', 'content', 'images', 'media']);

        return $this->sendGetPostResponse($request, $post);
    }

    /**
     * @param Request $request
     * @param PostItem|\Illuminate\Database\Eloquent\Builder $post
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendGetPostResponse(Request $request, $post)
    {
        return jsonSuccess(['post' => $post]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        if (!$request->has('sort')) {
            $request->offsetSet('sort', 'aid-desc');
        }
        $query = $this->repository()->filter($request->all());
        $total = $query->count();
        $items = $query->offset($request->input('offset', 0))
            ->limit($request->input('count', 15))->get();
        return $this->sendBatchGetPostResponse($request, $items, $total);
    }

    /**
     * @param Request $request
     * @param PostItem[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[] $items
     * @param int $total
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchGetPostResponse(Request $request, $items, $total)
    {
        return jsonSuccess(compact('total', 'items'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paginate(Request $request)
    {
        $paginator = $this->repository()->filter($request->all())->paginate($request->input('pagesize', 15));
        return $this->sendPaginatePostResponse($request, $paginator);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $paginator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendPaginatePostResponse(Request $request, $paginator)
    {
        return jsonSuccess([
            'total' => $paginator->total(),
            'pageSize' => $paginator->perPage(),
            'currentPage' => $paginator->currentPage(),
            'lastPage' => $paginator->lastPage(),
            'items' => $paginator->items(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $post = $this->repository()->findOrNew($request->input('aid'));
        if ($request->has('post')) {
            $post->fill($request->input('post', []))->save();
        }

        if ($request->has('content')) {
            $content = $request->input('content', []);
            if (is_array($content)) $content = $content['content'] ?? '';
            $post->content->update(['content' => $content]);
            if (!$post->summary) {
                $post->update(['summary' => mbsubstr(strip_html($content), 300)]);
            }
        }

        if ($request->has('images')) {
            $this->saveImages($post, $request->input('images', []));
        }

        if ($request->has('media')) {
            $this->saveMedia($post, $request->input('media', []));
        }

        return $this->sendSavedPostResponse($request, $post);
    }

    /**
     * @param \App\Models\PostItem $post
     * @param array $images
     */
    protected function saveImages(&$post, array $images)
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
    protected function saveMedia(&$post, array $attributes)
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
        return jsonSuccess(['post' => $post]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $items = $request->input('items', []);
        foreach ($this->repository()->whereKey($items)->get() as $item) {
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
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $items = $request->input('items', []);
        $data = $request->input('data', []);
        $this->repository()->whereKey($items)->update($data);
        return $this->sendBatchUpdatedPostResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchUpdatedPostResponse(Request $request)
    {
        return jsonSuccess();
    }
}
