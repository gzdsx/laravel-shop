@extends('layouts.h5')

@section('title', '牛王视频')

@section('content')
    <div class="video-list">
        @foreach ($items as $item)
            <div class="video-list-item">
                <a href="{{url('h5/video/detail/'.$item->id.'.html')}}">
                    <div class="display-flex">
                        <div class="bg-cover video-thumb" style="background-image: url({{$item->image}});"></div>
                        <div class="video-data">
                            <div class="video-title">{{$item->title}}</div>
                            <div class="video-content">{{$item->created_at->format('Y-m-d')}}</div>
                            <div class="flex"></div>
                            <div class="video-content">{{$item->content}}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
@stop