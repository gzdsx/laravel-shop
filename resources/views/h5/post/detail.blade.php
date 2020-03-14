@extends('layouts.h5')

@section('title', '正文')

@section('content')
    <div class="post-detail">
        <section class="head">
            <h1>{{$post->title}}</h1>
            <p style="float: right;">粗耕农品集市</p>
            <p>{{$post->created_at}}   |   浏览量 {{$post->views}}</p>
        </section>
        <div class="body">
            <div class="content">{!! $post->content['content'] !!}</div>
        </div>

        <div class="share">
            <div class="line"><span class="text">分享</span> </div>
            <ul class="item-list" id="shareChannel">
                <li data-action="share" data-target="weixin">
                    <img src="{{asset('images/share/weixin.png')}}" class="ico">
                    <p class="title">微信好友</p>
                </li>
                <li data-action="share" data-target="pengyouquan">
                    <img src="{{asset('images/share/pengyouquan.png')}}" class="ico">
                    <p class="title">微信朋友圈</p>
                </li>
                <li data-action="share" data-target="qq">
                    <img src="{{asset('images/share/qq.png')}}" class="ico">
                    <p class="title">QQ好友</p>
                </li>
                <li data-action="share" data-target="qzone">
                    <img src="{{asset('images/share/qzone.png')}}" class="ico">
                    <p class="title">QQ空间</p>
                </li>
            </ul>
        </div>

        <ul class="post-list">
            @foreach ($relations as $item)
                <li data-action="viewArticle" data-id="{{$item['aid']}}">
                    <div class="image bg-cover" style="background-image: url({{$item['image']}})"></div>
                    <div class="content">
                        <h3>{{mbsubstr($item['title'], 30)}}</h3>
                        <span class="views">{{$item['views']}}次阅读</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        function awaitPostMessage() {
            var isReactNativePostMessageReady = !!window.originalPostMessage;
            var queue = [];
            var currentPostMessageFn = function store(message) {
                if (queue.length > 100) queue.shift();
                queue.push(message);
            };
            if (!isReactNativePostMessageReady) {
                var originalPostMessage = window.postMessage;
                Object.defineProperty(window, 'postMessage', {
                    configurable: true,
                    enumerable: true,
                    get: function () {
                        return currentPostMessageFn;
                    },
                    set: function (fn) {
                        currentPostMessageFn = fn;
                        isReactNativePostMessageReady = true;
                        setTimeout(sendQueue, 0);
                    }
                });
                window.postMessage.toString = function () {
                    return String(originalPostMessage);
                };
            }

            function sendQueue() {
                while (queue.length > 0) window.postMessage(queue.shift());
            }
        }
        awaitPostMessage(); // Call this only once in your Web Code.

        window.postMessage(JSON.stringify({
            event:'shareMessage',
            data:{
                title:'{{$post['title']}}',
                message:'{{$post['summary']}}',
                pic:'{{image_url($post['image'])}}',
                link:window.location.href
            }
        }));
        $("[data-action=share]").on('click', function () {
            window.postMessage(JSON.stringify({
                event:'shareTo',
                data:$(this).attr('data-target')
            }));
        });

        $("[data-action=viewArticle]").on('click', function () {
            var aid = $(this).attr('data-id');
            window.postMessage(JSON.stringify({
                event:'viewArticle',
                aid:aid
            }));
            wx.miniProgram.navigateTo({url:'/pages/article/detail?aid='+aid});
        });
    </script>
@stop
