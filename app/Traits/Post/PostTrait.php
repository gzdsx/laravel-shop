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
use Illuminate\Support\Facades\Auth;

trait PostTrait
{
    protected $with = ['user', 'categories'];

    /**
     * @return Builder|PostItem
     */
    protected function repository()
    {
        return PostItem::withGlobalScope('available', function (Builder $builder) {
            return $builder->where('status', PostItem::STATUS_PUBLISH);
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function post(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('id'));
        $model->increment('views');
        $model->load(['user', 'images', 'media', 'categories', 'metas']);

        return json_success($model);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function posts(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        $query = $this->repository()->filter($request->all());
        return json_success([
            'total' => $query->count(),
            'items' => $query->with($this->with)->offset($offset)->limit($count)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {

        $model = $this->repository()->findOrNew($request->input('id'));
        $model->fill($request->input('post', []));
        $model->save();

        if ($request->has('categories')) {
            $model->categories()->sync($request->input('categories', []));
        }

        if ($request->has('content')) {
            $content = $model->content()->firstOrNew();
            $content->content = $request->input('content');
            $content->save();

            if (!$model->excerpt) {
                $model->excerpt = mbsubstr(strip_html($content->content), 200);
                $model->save();
            }
        }

        if ($request->has('media')) {
            $media = $model->media()->firstOrNew();
            $media->fill($request->input('media', []))->save();
        }

        if ($request->has('images')) {
            $images = $request->input('images', []);
            $model->images()->whereNotIn('id', collect($images)->pluck('id'))->delete();

            foreach ($images as $k => $v) {
                $v['sort_num'] = $k;
                $model->images()->updateOrCreate(['id' => $v['id'] ?? 0], $v);

                if (!$model->image) {
                    $model->image = $v['image'] ?? null;
                    $model->save();
                }
            }
        }

        return json_success(['id' => $model->id]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->each->delete();
        return json_success();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $data = $request->input('data', []);
        $this->repository()->whereKey($request->input('ids', []))->update($data);

        return json_success();
    }
}
