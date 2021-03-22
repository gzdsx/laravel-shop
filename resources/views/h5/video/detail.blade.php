@extends('layouts.h5')

@section('title', $video->title)

@section('content')
    <div class="video-detail">
        <div class="player">
            <div class="dplayer" id="dplayer"></div>
        </div>
        <div class="video-meta flex-row">
            <div class="video-title">{{$video->title}}</div>
            <span class="video-views">{{$video->views}}次播放</span>
        </div>
        @if ($video->content)
            <div class="video-content">{!! $video->content !!}</div>
        @endif
    </div>

    <div class="video-list">
        @foreach ($items as $item)
            <div class="video-list-item">
                <a href="{{$item->m_url}}">
                    <div class="bg-cover video-thumb" style="background-image: url({{$item->image}});"></div>
                    <div class="video-data">
                        <div class="video-title">{{$item->title}}</div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
@stop

@section('foot')
    <script src="{{asset('js/lib/DPlayer.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        new DPlayer({
            container: document.getElementById('dplayer'),
            video: {
                pic: '{{$video->image}}',
                url: '{{$video->source}}',
                type: 'mp4'
            },
            live: false,
            lang: 'zh-cn',
            autoplay: true,
            volume: 1,
        });
    </script>
@stop
