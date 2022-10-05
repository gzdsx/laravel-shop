<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class VideoTranscode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pathinfo = pathinfo($this->video->source);
        $savepath = str_replace(material_url(), '', $this->video->source);
        $filepath = material_path($savepath);
        $hlspath = dirname($filepath) . '/' . $pathinfo['filename'];
        $hlsfile = $hlspath . '/index.m3u8';
        $hlsurl = str_replace(material_path(), '', $hlsfile);
        @mkdir($hlspath);
        $command = "/usr/local/bin/ffmpeg -i $filepath -c copy -b:v 500k -hls_list_size 0 -hls_time 30 -hls_segment_filename \"$hlspath/%03d.ts\" $hlsfile";
        system($command, $return);

        //生成缩略图
        $image = 'video/cover/' . Str::random(40) . '.jpg';
        $imagePath = material_path($image);
        @mkdir(dirname($imagePath));
        $command2 = "/usr/local/bin/ffmpeg -i $filepath -ss 00:00:02 -f image2 -y $imagePath";
        system($command2);

        //删除原文件
        @unlink($filepath);

        $this->video->transcoded = 1;
        $this->video->source = $hlsurl;
        $this->video->image = $image;
        $this->video->state = 1;
        $this->video->save();
    }
}
