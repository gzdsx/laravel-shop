<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Api\BaseController;
use App\Traits\Common\MaterialTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KindeditorController extends BaseController
{
    use MaterialTrait;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request){

        $dir = $request->get('dir');

        if ($file = $request->file('imgFile')){
            if ($dir === 'image') {
                $image = $this->storeImage($file);
                return response()->json([
                    'error'=>0,
                    'url'=>$image->source
                ]);
            }else {
                $material = $this->storeFile($file);
                return response()->json([
                    'error'=>0,
                    'url'=>$material->source
                ]);
            }
        }else {
            return response()->json([
                'error'=>1,
                'message'=>'file upload failed!'
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function manager(Request $request){

        $dir = $request->get('dir');

        $file_list = [];
        if ($dir === 'image') {
            Auth::user()->materials()->where('type','image')
                ->orderByDesc('id')->limit(100)->get()
                ->map(function ($m) use (&$file_list){
                    $file_list[] = [
                    'is_dir'=>false,
                    'has_file'=>false,
                    'is_photo'=>true,
                    'filesize'=>$m->size,
                    'filetype'=>$m->extension,
                    'filename'=>$m->name,
                    'datetime'=>$m->created_at,
                    'thumburl'=>$m->thumb,
                    'url'=>$m->image
                ];
            });
        }

        if ($dir === 'media') {
            Auth::user()->materials()->whereIn('type', ['video', 'voice'])->orderByDesc('id')
                ->limit(100)->get()->map(function ($m) use (&$file_list){
                    $file_list[] = [
                        'is_dir'=>false,
                        'has_file'=>false,
                        'is_photo'=>false,
                        'filesize'=>$m->size,
                        'filetype'=>$m->extension,
                        'filename'=>$m->name,
                        'datetime'=>$m->created_at,
                        'url'=>$m->source
                    ];
                });
        }

        if ($dir === 'file') {
            Auth::user()->materials()->whereIn('type', ['doc', 'file'])->orderByDesc('id')
                ->limit(100)->get()->map(function ($m) use (&$file_list){
                    $file_list[] = [
                        'is_dir'=>false,
                        'has_file'=>false,
                        'is_photo'=>false,
                        'filesize'=>$m->size,
                        'filetype'=>$m->extension,
                        'filename'=>$m->name,
                        'datetime'=>$m->created_at,
                        'url'=>$m->source
                    ];
                });
        }

        return response()->json([
            'total_count'=>count($file_list),
            'file_list'=>$file_list,
            'current_url'=>'',
            'moveup_dir_path'=>'',
            'current_dir_path'=>''
        ]);
    }
}
