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


use App\Models\CommonMaterial;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait MaterialTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Builder|CommonMaterial
     */
    protected function repository()
    {
        return Auth::user()->materials();
    }

    /**
     * @param Request $request
     * @return CommonMaterial|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $type = $request->input('type', 'image');
        if ($type === 'image') {
            return $this->storeImage($request);
        } else {
            return $this->storeFile($request);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function storeImage(Request $request)
    {
        if (!$file = $request->file('file')) {
            return $this->uploadFail($request);
        }

        $hashName = $file->hashName(date('Y') . '/' . date('m'));
        $material = $this->repository()->make();
        $material->type = 'image';
        $material->name = $file->getClientOriginalName();
        $material->extension = $file->getClientOriginalExtension();
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

        //大图
        $imagePath = 'image/' . $hashName;
        Storage::makeDirectory(dirname($imagePath));
        //$maxWidth = intval(settings('image_max_width'));
        $maxWidth = $request->input('width', intval(settings('image_max_width')));

        if ($request->input('fit')) {
            $width = min($maxWidth, $image->width(), $image->height());
            if ($request->has('height')) {
                $height = min($image->height(), $request->input('height', 0));
            } else {
                $height = null;
            }

            $image->fit($width, $height);
        } else {
            if ($image->width() > $maxWidth) {
                $image->resize($maxWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
        }

        //缩略图
        $thumb = clone $image;
        $thumbPath = 'thumb/' . $hashName;
        Storage::makeDirectory(dirname($thumbPath));
        $thumbWidth = intval(settings('image_thumb_width'));
        if ($image->width() > $thumbWidth) {
            $thumb->resize($thumbWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $thumb->save(material_path($thumbPath), 80);

        //添加水印
        if (settings('water_mark') == '1') {
            $width = $image->width();
            $height = $image->height();
            $x = intval(settings('water_offset_x'));
            $y = intval(settings('water_offset_y'));
            if (settings('water_type') == '1') {
                $water = Image::make(base_path(settings('water_image')));
                $image->insert($water, settings('water_pos'), $x, $y);
            } else {
                $text = settings('water_text');
                $fontSize = intval(settings('water_size'));
                $textWidth = $fontSize * mb_strlen($text);
                switch (settings('water_pos')) {
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
                    $font->file(base_path(settings('water_font')));
                    $font->size(intval(settings('water_size')));
                    $font->color(settings('water_color'));
                    $font->align('left');
                    $font->valign('top');
                });
            }
        }

        $image->save(material_path($imagePath), 80);
        $material->size = $image->filesize();
        $material->width = $image->width();
        $material->height = $image->height();
        $material->thumb = $thumbPath;
        $material->source = $imagePath;
        $material->save();

        return $this->uploadSuccess($request, $material);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeFile(Request $request)
    {
        if (!$file = $request->file('file')) {
            return $this->uploadFail($request);
        }

        $material = $this->repository()->make([
            'extension' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'name' => $file->getClientOriginalName(),
            'mime' => $file->getMimeType(),
        ]);

        $extension = $file->getClientOriginalExtension();
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

        return $this->uploadSuccess($request, $material);
    }

    /**
     * @param Request $request
     * @param $file
     * @return \Illuminate\Http\JsonResponse
     */
    protected function uploadSuccess(Request $request, $material)
    {
        return jsonSuccess($material);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function uploadFail(Request $request)
    {
        return jsonError(500, 'material upload fail');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInfo(Request $request)
    {
        $material = $this->repository()->findOrFail($request->input('id'));
        return jsonSuccess($material);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
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
     */
    public function delete(Request $request)
    {
        $material = $this->repository()->find($request->input('id'));
        if ($material) {
            $material->delete();
        }

        return $this->deletedSuccess($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function batchDelete(Request $request)
    {
        $this->repository()->whereKey($request->input('ids', []))->get()->each->delete();
        return $this->deletedSuccess($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function deletedSuccess(Request $request)
    {
        return jsonSuccess();
    }
}
