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

trait PostItemTrait
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
    public function getInfo(Request $request)
    {
        $model = $this->repository()->findOrFail($request->input('aid'));
        $model->increment('views');
        $model->load(['user', 'images', 'media']);

        return jsonSuccess($model);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $offset = $request->input('offset', 0);
        $count = $request->input('count', 15);
        $query = $this->repository()->filter($request->all());
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($offset)->limit($count)->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {

        $model = $this->repository()->findOrNew($request->input('aid'));
        $model->fill($request->input('post', []));
        if (!$model->uid) {
            $model->user()->associate(Auth::id());
        }
        $model->save();

        if ($request->has('content')) {
            $content = $model->content()->firstOrNew();
            $content->content = $request->input('content');
            $content->save();

            if (!$model->summary) {
                $model->summary = mbsubstr(strip_html($content->content), 200);
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

        return jsonSuccess(['aid' => $model->aid]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        if ($model = $this->repository()->find($request->input('aid'))) {
            $model->delete();
        }

        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->each->delete();
        return jsonSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchUpdate(Request $request)
    {
        $data = $request->input('data', []);
        $this->repository()->whereKey($request->input('ids', []))->update($data);

        return jsonSuccess();
    }
}
