<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="{{asset('videojs/video-js.min.css?v=3')}}" rel="stylesheet">
    <script src="{{asset('videojs/video.min.js')}}"></script>
    <script src="{{asset('videojs/lang/zh-CN.js')}}"></script>
    <script src="{{asset('videojs/http-streaming.min.js')}}"></script>
    <script src="{{asset('js/lib/DPlayer.min.js')}}"></script>
    <script src="{{asset('js/lib/hls.min.js')}}"></script>
</head>
<body>
{{--<div style="width: 640px; height: 480px; position: relative;">--}}
{{--        <video--}}
{{--                id="video"--}}
{{--                class="video-js vjs-big-play-centered"--}}
{{--                playsinline--}}
{{--                webkit-playsinline--}}
{{--                x-webkit-airplay="allow"--}}
{{--                x5-mse-live-streaming--}}
{{--                style="width: 100%; height: 100%;"--}}
{{--        >--}}
{{--        </video>--}}
{{--</div>--}}
<div id="dplayer" style="width: 640px; height: 480px;"></div>
<script>
    // var video = videojs('video', {
    //     language: 'zh-CN',
    //     sources: [
    //         {
    //             src: '//play.gzdsx.cn/vod/5ef9336202291/index.m3u8',
    //             type: 'application/x-mpegURL',
    //             withCredentials: false
    //         }
    //     ],
    //     notSupportedMessage: '暂时无法播放此视频',
    //     autoplay: false,
    //     controls: true,
    // }, function () {
    //     videojs.log('Your player is ready!');
    //
    //     // In this context, `this` is the player that was created by Video.js.
    //     //this.play();
    //
    //     // How about an event listener?
    //     this.on('ended', function () {
    //         videojs.log('Awww...over so soon?!');
    //     });
    // });

    var dp = new DPlayer({
        container: document.getElementById('dplayer'),
        video: {
            quality: [
                {
                    name: '高清',
                    url: '//play.gzdsx.cn/vod/5efa2a4e3495a/index.m3u8',
                    type: 'hls',
                },
                {
                    name: '标清',
                    url: '//play.gzdsx.cn/vod/5efa2a4e3495a/index.m3u8',
                    type: 'hls',
                },
            ],
            defaultQuality: 1
        },
        live: false,
        lang: 'zh-cn',
        autoplay:true,
        volume:1,
        playbackSpeed:[0.5, 0.75, 1, 1.25, 1.5, 2],

    });

</script>
</body>
</html>
