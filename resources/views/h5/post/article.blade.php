@extends('layouts.h5')

@section('title', $post->title)

@section('content')
    <div class="news-detail">
        <section class="head">
            <h1>{{$post->title}}</h1>
            <p style="float: right;">{{env('APP_NAME')}}</p>
            <p>{{$post->created_at}} | 浏览量 {{$post->views}}</p>
        </section>
        <div class="body" style="background-color: #fff;">
            <div class="content">{!! clean_style($post->content['content']) !!}</div>
        </div>

        <div class="share">
            <div class="line"><span class="text">分享</span></div>
            <ul class="item-list" id="shareChannel">
                <li onclick="viewShare('weixin')">
                    <img src="{{asset('images/share/weixin.png')}}" class="ico" alt="">
                    <p class="title">微信好友</p>
                </li>
                <li onclick="viewShare('pengyouquan')">
                    <img src="{{asset('images/share/pengyouquan.png')}}" class="ico" alt="">
                    <p class="title">微信朋友圈</p>
                </li>
                <li onclick="viewShare('qq')">
                    <img src="{{asset('images/share/qq.png')}}" class="ico" alt="">
                    <p class="title">QQ好友</p>
                </li>
                <li onclick="viewShare('qzone')">
                    <img src="{{asset('images/share/qzone.png')}}" class="ico" alt="">
                    <p class="title">QQ空间</p>
                </li>
            </ul>
        </div>

        <ul class="news-list">
            @foreach ($items as $item)
                <li class="postItem" data-id="{{$item->aid}}" onclick="viewPost({{$item->aid}})">
                    @if ($item->image)
                        <div class="image bg-cover" style="background-image: url({{$item->image}})"></div>
                    @endif
                    <div class="content">
                        <h3 style="font-weight: 400;">{{mbsubstr($item->title, 30)}}</h3>
                        <div class="flex"></div>
                        <div class="display-flex">
                            <div class="time">{{$item->created_at}}</div>
                            <span class="views">{{$item->views}}次阅读</span>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        function viewShare(shareTo) {
            window.ReactNativeWebView.postMessage(JSON.stringify({
                event: 'onShare',
                shareTo: shareTo
            }));
        }

        function viewPost(aid) {
            window.ReactNativeWebView.postMessage(JSON.stringify({
                event: 'onPressItem',
                aid: aid
            }));
        }
    </script>
@stop
