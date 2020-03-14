<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Traits\Common\MaterialTrait;
use Illuminate\Http\Request;

class KindeditorController extends Controller
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

    public function manager(Request $request){

        $dir = $request->get('dir');

        $file_list = [];
        if ($dir === 'image') {
            $this->user()->materials()->image()->orderByDesc('id')->limit(100)->get()->map(function ($m) use (&$file_list){
                    $file_list[] = [
                    'is_dir'=>false,
                    'has_file'=>false,
                    'is_photo'=>true,
                    'filesize'=>$m->size,
                    'filetype'=>$m->extension,
                    'filename'=>$m->name,
                    'datetime'=>$m->created_at,
                    'thumburl'=>$m->thumb,
                    'url'=>$m->source
                ];
            });
        }

        if ($dir === 'media') {
            $this->user()->materials()->whereIn('type', ['video', 'voice'])->orderByDesc('id')
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
            $this->user()->materials()->whereIn('type', ['doc', 'file'])->orderByDesc('id')
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
            'current_url'=>material_url(),
            'moveup_dir_path'=>'',
            'current_dir_path'=>''
        ]);
    }
}
