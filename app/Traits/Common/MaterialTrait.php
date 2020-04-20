<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2018 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: http://www.dsxcms.com
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2018/11/16
 * Time: 1:57 PM
 */

namespace App\Traits\Common;


use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

trait MaterialTrait
{
    /**
     * @return Material|\Illuminate\Database\Eloquent\Builder
     */
    protected function query(){
        return Material::query();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImg(Request $request)
    {
        if ($file = $request->file('file')) {
            $image = $this->storeImage($file);
            return $this->sendImageUploadedResponse($request, $image);
        } else {
            return $this->sendImageUploadFailedResponse($request);
        }
    }

    /**
     * @param UploadedFile $file
     * @return \Illuminate\Database\Eloquent\Model|\App\Models\Material
     */
    protected function storeImage(UploadedFile $file)
    {
        $img = Image::make($file->getRealPath());
        if ($img->exif('Orientation')){
            switch ($img->exif('Orientation')) {
                case 8:
                    $img->rotate(90);
                    break;
                case 3:
                    $img->rotate(180);
                    break;
                case 6:
                    $img->rotate(-90);
                    break;
            }
        }
        $material = [
            'type' => 'image',
            'extension' => $file->extension(),
            'size' => $file->getSize(),
            'name' => $file->getClientOriginalName(),
            'width' => $img->width(),
            'height' => $img->height()
        ];

        $filename = $file->hashName();
        $imagePath = 'image/' . date('Y') . '/' . date('m') . '/' . $filename;
        $thumbPath = 'thumb/' . date('Y') . '/' . date('m') . '/' . $filename;

        //大图
        @mkdir(dirname(material_path($imagePath)), 0777, true);
        if ($img->getWidth() > 1600) {
            $scale = 1600 / $img->getWidth();
            $img->resize(1600, $img->getHeight() * $scale)->save(material_path($imagePath));
        } else {
            $img->save(material_path($imagePath));
        }

        //缩略图
        @mkdir(dirname(material_path($thumbPath)), 0777, true);
        if ($img->getWidth() > 500) {
            $scale = 500 / $img->getWidth();
            $img->resize(500, $img->getHeight() * $scale)->save(material_path($thumbPath));
        } else {
            $img->save(material_path($thumbPath));
        }

        $material['source'] = $imagePath;
        $material['thumb'] = $thumbPath;

        return $this->query()->create($material);
    }

    /**
     * @param Request $request
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendImageUploadedResponse(Request $request, $material)
    {
        $image = $material->only(['id', 'name', 'image', 'thumb', 'width', 'height', 'size']);
        return ajaxReturn(['image' => $image]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendImageUploadFailedResponse(Request $request)
    {
        return ajaxError(400, 'upload image failed');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request)
    {
        if ($file = $request->file('file')) {
            $material = $this->storeFile($file);
            return $this->sendFileUploadedResponse($request, $material);
        } else {
            return $this->sendFileUploadFailedResponse($request);
        }
    }

    /**
     * @param UploadedFile $file
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function storeFile(UploadedFile $file)
    {
        $extension = $file->extension();
        $material = [
            'extension' => $extension,
            'size' => $file->getSize(),
            'name' => $file->getClientOriginalName(),
            'width' => 0,
            'height' => 0
        ];

        if (in_array($extension, ['jpg', 'jpeg', 'gif', 'png', 'bmp'])) {
            $material['type'] = 'image';
        } elseif (in_array($extension, ['mp4', 'mpeg', 'mpg', 'rmvb', 'rm', 'avi', 'wmv'])) {
            $material['type'] = 'video';
        } elseif (in_array($extension, ['mp3', 'midi', 'wav'])) {
            $material['type'] = 'voice';
        } elseif (in_array($extension, ['doc', 'ppt', 'xls', 'docx', 'pptx', 'xlsx', 'pdf', 'txt'])) {
            $material['type'] = 'doc';
        } else {
            $material['type'] = 'file';
        }

        $material['source'] = $file->store($material['type'] . '/' . date('Y') . '/' . date('m'));
        return $this->query()->create($material);
    }

    /**
     * @param Request $request
     * @param $file
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendFileUploadedResponse(Request $request, $file)
    {
        return ajaxReturn(['file' => $file]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendFileUploadFailedResponse(Request $request)
    {
        return ajaxError(400, 'upload file fail');
    }
}
