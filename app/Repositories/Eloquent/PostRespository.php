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
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|string
     */
    public function model()
    {
        // TODO: Implement getModel() method.
        return PostItem::class;
    }

    /**
     * @param PostItem $postItem
     * @param $content
     * @return PostItem
     */
    public function updateContent($postItem, $content)
    {
        // TODO: Implement updateContent() method.
        if (is_string($content)) {
            $postItem->content->update(['content' => $content]);
        } else {
            $postItem->content->update($content);
        }
        return $postItem;
    }

    /**
     * @param PostItem $postItem
     * @param array $images
     * @return PostItem
     */
    public function updateImages($postItem, array $images)
    {
        // TODO: Implement updateImages() method.
        if ($images) {
            $displayorder = 0;
            $imageIds = $postItem->images->pluck('id');
            foreach ($images as $image) {
                if (!$postItem->image) $postItem->image = $image['thumb'];
                $imgid = $image['id'];
                $image['displayorder'] = $displayorder++;
                if ($imageIds->has($imgid)) {
                    $postItem->images()->where('id', $imgid)->update($image);
                    $imageIds->forget($imgid);
                } else {
                    $postItem->images()->create($image);
                }
            }
            $postItem->images()->whereIn('id', $imageIds)->delete();
        } else {
            $postItem->images()->delete();
        }
        $postItem->save();
        return $postItem;
    }

    /**
     * @param PostItem $postItem
     * @param array $media
     * @return PostItem
     */
    public function updateMedia($postItem, array $media)
    {
        // TODO: Implement updateMedia() method.
        if ($postItem->media) {
            $postItem->media->update($media);
        } else {
            $postItem->media()->create($media);
        }
        return $postItem;
    }
}
