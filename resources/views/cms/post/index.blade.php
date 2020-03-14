@extends('layouts.default')

@section('title', '联谊会动态')

@section('content')
    <div class="area article">
        <div class="article-left">
            <ul class="article-list">
                @foreach($itemlist as $item)
                    <li>
                        <div class="image bg-cover" style="background-image: url({{image_url($item['image'])}});"></div>
                        <div class="content">
                            <h2 class="title"><a href="{{post_url($item['aid'])}}" target="_blank">{{$item['title']}}</a></h2>
                            <p class="digest">{{substring($item['summary'], 100)}}</p>
                            <div class="bottom">
                                <span>{{date('Y-m-d', $item['created_at'])}}</span>
                                <span>{{$item['view_num']}}阅读</span>
                                <span>{{$item['comment_num']}}评论</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="page-wrap">{!! $pagination !!}</div>
        </div>
    </div>
@stop
