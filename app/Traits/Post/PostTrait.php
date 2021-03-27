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
     * @return Builder|PostItem
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
        $newPost = collect($request->input('post', []));
        $post = $this->repository()->findOrNew($request->input('aid'));
        $post->fill($newPost->all())->save();

        if ($newPost->has('content')) {
            $this->saveContent($post, $newPost->get('content', []));
        }

        if ($newPost->has('images')) {
            $this->saveImages($post, $newPost->get('images', []));
        }

        if ($newPost->has('media')) {
            $this->saveMedia($post, $newPost->get('media', []));
        }

        return $this->sendSavedPostResponse($request, $post);
    }

    /**
     * @param \App\Models\PostItem $post
     * @param array $content
     */
    protected function saveContent(&$post, array $content)
    {
        $post->content->fill($content)->save();
        if (!$post->summary) {
            $post->summary = mbsubstr(strip_html($post->content->content), 300);
            $post->save();
        }
    }

    /**
     * @param \App\Models\PostItem $post
     * @param array $images
     */
    protected function saveImages(&$post, array $images)
    {
        $images = collect($images);
        $post->images()->whereNotIn('id', $images->pluck('id'))->delete();

        foreach ($images as $image) {
            $newImage = $post->images()->findOrNew($image['id'] ?? 0);
            $newImage->fill($image)->save();

            if (!$post->image) {
                $post->image = $newImage->image;
                $post->save();
            }
        }
    }

    /**
     * @param \App\Models\PostItem $post
     * @param array $attributes
     */
    protected function saveMedia(&$post, array $media)
    {
        // TODO: Implement updateMedia() method.
        if ($post->media) {
            $post->media->fill($media)->save();
        } else {
            $post->media()->create($media);
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
