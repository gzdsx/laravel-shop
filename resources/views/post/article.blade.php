@extends('layouts.default')

@section('title', $post->title)
@section('keywords', $post->tags)
@section('description', $post->summary)


@section('content')
    <div class="post-detail">
        <div class="area">
            <div class="main-frame">
                <h1 class="post-title">{{$post->title}}</h1>
                <div class="post-info">
                    <span>{{$post->created_at->format('Y年m月d日 H:i')}}</span>
                    <span>阅读:{{$post->views}}</span>
                    <a>评论:({{$post->comments}})</a>
                    <a data-action="addToCollection" data-id="{{$post->aid}}">收藏本文</a>
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
                <div class="frame-section">
                    <h3 class="title">热点文章</h3>
                    <ul class="postlist">
                        @foreach ($newPostList as $item)
                            <li><a href="{{$item->url}}">{{$item['title']}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="blank"></div>
                <div class="frame-section">
                    <h3 class="title">热点图文</h3>
                    <ul class="piclist">
                        @foreach ($hotPostList as $item)
                            <li>
                                <div class="thumb">
                                    <a href="{{$item->url}}">
                                        <img src="{{image_url($item['image'])}}">
                                    </a>
                                </div>
                                <div class="title">
                                    <a href="{{$item->url}}">{{$item['title']}}</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
