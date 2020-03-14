@extends('layouts.mall')

@section('title', $post['title'])
@section('keywords', $keywords)
@section('description', $description)

@section('styles')
    <link href="{{asset('css/post/index.css')}}" rel="stylesheet" type="text/css">
@stop
@section('content')
    <div class="area post-detail-div">
        <div class="main-frame">
            <h1 class="post-title">{{$post['title']}}</h1>
            <div class="post-info">
                <span>{{@date('Y年m月d日 H:i',$post['created_at'])}}</span>
                <span>阅读:{{$post['views']}}</span>
                <a>评论:({{$post['comments']}})</a>
                <a data-action="addToCollection" data-id="{{$aid}}" data-type="article">收藏本文</a>
            </div>

            <div class="post-body">{!! $post->content['content'] !!}</div>
            @if ($post['tags'])
                <div class="post-tags">标签:
                    @foreach ($post['tags'] as $tag)
                        <a href="">{$tag}</a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="right-frame">
            <div class="content-div">
                <h3 class="title">热点文章</h3>
                <ul class="itemlist">
                    @foreach ($newPostList as $item)
                        <li><a href="{{post_url($item['aid'])}}">{{$item['title']}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="blank"></div>
            <div class="content-div">
                <h3 class="title">热点图文</h3>
                <ul class="picitemlist">
                    @foreach ($hotPostList as $item)
                        <li>
                            <div class="imgbox">
                                <a href="{{post_url($item['aid'])}}">
                                    <img src="{{image_url($item['image'])}}">
                                </a>
                            </div>
                            <div class="title">
                                <a href="{{post_url($item['aid'])}}">{{$item['title']}}</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop
