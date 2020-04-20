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

namespace App\Traits\Cms;


use App\Models\PostItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait PostTrait
{

    /**
     * @return bool
     */
    protected function authenticate()
    {
        return true;
    }

    /**
     * @return bool
     */
    protected function withoutGlobalScopes(){
        return true;
    }

    /**
     * @return PostItem|Builder
     */
    public function query()
    {
        $query = PostItem::query();
        if ($this->withoutGlobalScopes()) $query = $query->withoutGlobalScopes();
        if ($this->authenticate()){
            $query = $query->withoutGlobalScopes()->withGlobalScope('author', function (Builder $builder) {
                return $builder->where('uid', Auth::id());
            });
        }
        return $query;
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

        return $this->sendSavedResponse($request, $post);
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
    protected function sendSavedResponse(Request $request, $post)
    {
        return ajaxReturn(['post' => $post]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function batchDelete(Request $request)
    {
        $items = $request->input('items', []);
        foreach ($this->query()->whereKey($items)->get() as $item) {
            $item->delete();
        }

        return $this->sendBatchDeletedResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchDeletedResponse(Request $request)
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
        return $this->sendBatchUpdatedResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendBatchUpdatedResponse(Request $request)
    {
        return ajaxReturn();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $post = $this->query()->findOrFail($request->input('aid'));
        $post->load(['user', 'content', 'images', 'media', 'catlog']);

        return $this->sendGetPostResponse($request, $post);
    }

    /**
     * @param Request $request
     * @param PostItem|\Illuminate\Database\Eloquent\Builder $post
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendGetPostResponse(Request $request, $post)
    {
        return ajaxReturn(['post' => $post]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->query()->filter($request->all());
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
        return ajaxReturn(compact('total', 'items'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paginate(Request $request)
    {
        $paginator = $this->query()->filter($request->all())->paginate($request->input('pagesize', 15));
        return $this->sendPaginatePostResponse($request, $paginator);
    }

    /**
     * @param Request $request
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $paginator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendPaginatePostResponse(Request $request, $paginator)
    {
        return ajaxReturn([
            'total' => $paginator->total(),
            'pageSize' => $paginator->perPage(),
            'currentPage' => $paginator->currentPage(),
            'lastPage' => $paginator->lastPage(),
            'items' => $paginator->items(),
        ]);
    }
}
