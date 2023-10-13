@extends('layouts.default')

@section('title', $post->title)
@section('keywords', $post->tags)
@section('description', $post->excerpt)
@section('body_class','post-detail')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-lg-9">
                <div class="page-section">
                    <div class="post-main-content">
                        <h1 class="post-title">{{$post->title}}</h1>
                        <div class="post-meta">
                            <span>{{$post->from}}</span>
                            <span> · </span>
                            <span>{{$post->views}}浏览</span>
                            <span> · </span>
                            <span>{{$post->comment_num}}评论</span>
                            <span> · </span>
                            <span>{{$post->created_at}}</span>
                        </div>
                        @if($post->excerpt)
                            <div class="post-summary">{{$post->excerpt}}</div>
                        @endif

                        @if($post->content)
                            <div class="post-content">{!! $post->content->content !!}</div>
                        @endif

                        @if ($tags)
                            <div class="post-tags">标签:
                                @foreach ($tags as $tag)
                                    @if($tag)
                                        <a href="">{$tag}</a>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        <div class="post-section-title">
                            <p>相关阅读</p>
                        </div>

                        <ul class="post-list">
                            @foreach (post_query()->orderByDesc('views')->limit(10)->get() as $item)
                                <li>
                                    @if ($item->image)
                                        <div class="thumb">
                                            <a href="{{$item->url}}">
                                                <img src="{{$item->image}}" alt="{{$item->title}}">
                                            </a>
                                        </div>
                                    @endif
                                    <div class="flex-fill overflow-hidden position-relative">
                                        <div class="title"><a href="{{$item->url}}">{{$item->title}}</a></div>
                                        <p>{!! $item->summary !!}</p>
                                        <div class="bot">
                                            <span>{{$item->from}} · {{$item->views}}浏览 · {{$item->created_at}}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col col-lg-3">
                <div class="post-tougao">
                    <a>
                        <span class="iconfont icon-daohang font-22"></span>
                        <span>投稿</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
