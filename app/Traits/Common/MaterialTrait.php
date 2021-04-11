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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait MaterialTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Builder|Material
     */
    protected function repository()
    {
        return Auth::user()->materials();
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
        $hashName = $file->hashName(date('Y') . '/' . date('m'));
        $material = $this->repository()->make();
        $material->type = 'image';
        $material->name = $file->getClientOriginalName();
        $material->extension = $file->getExtension();
        $material->mime = $file->getMimeType();

        $image = Image::make($file->getRealPath());
        if ($image->exif('Orientation')) {
            switch ($image->exif('Orientation')) {
                case 8:
                    $image->rotate(90);
                    break;
                case 3:
                    $image->rotate(180);
                    break;
                case 6:
                    $image->rotate(-90);
                    break;
            }
        }

        //缩略图
        $thumb = clone $image;
        $thumbPath = 'thumb/' . $hashName;
        Storage::makeDirectory(dirname($thumbPath));
        $thumbWidth = intval(setting('image_thumb_width'));
        $thumb->resize($thumbWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(Storage::path($thumbPath), 80);

        //大图
        $imagePath = 'image/' . $hashName;
        Storage::makeDirectory(dirname($imagePath));
        $maxWidth = intval(setting('image_max_width'));
        $image->resize($maxWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        //添加水印
        if (setting('water_mark') == '1') {
            $width = $image->width();
            $height = $image->height();
            $x = intval(setting('water_offset_x'));
            $y = intval(setting('water_offset_y'));
            if (setting('water_type') == '1') {
                $water = Image::make(base_path(setting('water_image')));
                $image->insert($water, setting('water_pos'), $x, $y);
            } else {
                $text = setting('water_text');
                $fontSize = intval(setting('water_size'));
                $textWidth = $fontSize * mb_strlen($text);
                switch (setting('water_pos')) {
                    case 'top-left':
                        $tx = $x;
                        $ty = $y;
                        break;
                    case 'top-center':
                        $tx = $width / 2 + $x;
                        $ty = $y;
                        break;
                    case 'top-right':
                        $tx = $width - $textWidth;
                        $ty = $y;
                        break;
                    case 'left':
                        $tx = $x;
                        $ty = ($height - $fontSize) / 2 + $y;
                        break;
                    case 'center':
                        $tx = ($width - $textWidth) / 2 + $x;
                        $ty = ($height - $fontSize) / 2 + $y;
                        break;
                    case 'right':
                        $tx = ($width - $textWidth) + $x;
                        $ty = ($height - $fontSize) / 2 + $y;
                        break;
                    case 'bottom-left':
                        $tx = $x;
                        $ty = ($height - $fontSize) + $y;
                        break;
                    case 'bottom-center':
                        $tx = ($width - $textWidth) / 2 + $x;
                        $ty = ($height - $fontSize) + $y;
                        break;
                    case 'bottom-right':
                        $tx = ($width - $textWidth) + $x;
                        $ty = ($height - $fontSize) + $y;
                        break;
                    default:
                        $tx = $x;
                        $ty = $y;
                }
                $image->text($text, $tx, $ty, function ($font) {
                    $font->file(base_path(setting('water_font')));
                    $font->size(intval(setting('water_size')));
                    $font->color(setting('water_color'));
                    $font->align('left');
                    $font->valign('top');
                });
            }
        }
        $image->save(Storage::path($imagePath), 80);
        $material->size = $image->filesize();
        $material->width = $image->width();
        $material->height = $image->height();
        $material->thumb = $thumbPath;
        $material->source = $imagePath;
        $material->save();

        return $material;
    }

    /**
     * @param Request $request
     * @param \App\Models\Material $material
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendImageUploadedResponse(Request $request, $material)
    {
        $image = $material->only(['id', 'name', 'image', 'thumb', 'width', 'height', 'size']);
        return jsonSuccess(['image' => $image]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendImageUploadFailedResponse(Request $request)
    {
        return jsonError(400, 'upload image failed');
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
        $material = $this->repository()->make([
            'extension' => $file->getExtension(),
            'size' => $file->getSize(),
            'name' => $file->getClientOriginalName(),
            'mime' => $file->getMimeType(),
        ]);

        $extension = $file->extension();
        if (in_array($extension, ['jpg', 'jpeg', 'gif', 'png', 'bmp'])) {
            $material->type = 'image';
        } elseif (in_array($extension, ['mp4', 'mpeg', 'mpg', 'rmvb', 'rm', 'avi', 'wmv'])) {
            $material->type = 'video';
        } elseif (in_array($extension, ['mp3', 'midi', 'wav'])) {
            $material->type = 'voice';
        } elseif (in_array($extension, ['doc', 'ppt', 'xls', 'docx', 'pptx', 'xlsx', 'pdf', 'txt'])) {
            $material->type = 'doc';
        } else {
            $material->type = 'file';
        }

        $sourcePath = $material->type . '/' . date('Y') . '/' . date('m');
        Storage::makeDirectory($sourcePath);
        $material->source = $file->store($sourcePath);
        $material->save();

        return $material;
    }

    /**
     * @param Request $request
     * @param $file
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendFileUploadedResponse(Request $request, $file)
    {
        return jsonSuccess(['file' => $file]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendFileUploadFailedResponse(Request $request)
    {
        return jsonError(500, 'upload file fail');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $material = $this->repository()->findOrFail($request->input('id'));
        return jsonSuccess(['material' => $material]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchget(Request $request)
    {
        $query = $this->repository()->where('type', $request->input('type', 'image'));
        return jsonSuccess([
            'total' => $query->count(),
            'items' => $query->offset($request->input('offset', 0))
                ->limit($request->input('count', 10))->orderByDesc('id')->get()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $items = $this->repository()->whereKey($request->input('items', []))->get();
        foreach ($items as $item) {
            $item->delete();
        }
        return $this->sendFileDeletedResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendFileDeletedResponse(Request $request)
    {
        return jsonSuccess();
    }
}
