@extends('layouts.default')

@section('title', '联谊会动态')

@section('content')
    <div class="area article">
        <div class="article-left">
            <ul class="article-list">
                @foreach($items as $item)
                    <li>
                        <div class="image bg-cover" style="background-image: url({{image_url($item['image'])}});"></div>
                        <div class="content">
                            <h2 class="title"><a href="{{$item->url}}" target="_blank">{{$item->title}}</a></h2>
                            <p class="digest">{{mbsubstr($item->summary, 100)}}</p>
                            <div class="bottom">
                                <span>{{$item->created_at}}</span>
                                <span>{{$item->views}}阅读</span>
                                <span>{{$item->comments}}评论</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="page-wrap">{!! $items->render() !!}</div>
        </div>
    </div>
@stop
