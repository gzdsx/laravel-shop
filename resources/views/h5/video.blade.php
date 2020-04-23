@extends('layouts.h5')

@section('title', '牛王视频')

@section('content')
    <div class="video-list">
        @foreach ($items as $item)
            <div class="video-list-item">
                <a href="{{$item->link}}">
                    <div class="display-flex">
                        <div class="bg-cover video-thumb" style="'background-image: url({{$item->image}});'"></div>
                        <div class="video-data">
                            <div class="video-title">{{$item->title}}</div>
                            <div class="video-content">{{$item->content}}</div>
                            <div class="flex"></div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
@stop
