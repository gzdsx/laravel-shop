@extends('layouts.video')

@section('title', $video->title)

@section('content')
    <div class="video-detail">
        <div class="area">
            <div class="video-main">
                <div class="video-main-content">
                    <div class="video-player" id="dplayer"></div>
                    <div class="video-title">{{$video->title}}</div>
                    <div class="video-section-title">
                        <p>推荐直播</p>
                    </div>
                    <div class="video-list">
                        @foreach ($items as $item)
                            <div class="video-list-item">
                                <div class="list-item-bg">
                                    <div class="thumb">
                                        <a href="{{$item->url}}"><img src="{{$item->image}}" alt=""></a>
                                    </div>
                                    <div class="meta">
                                        <div class="title">{{$item->title}}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="video-right"></div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        var options = {
            container: document.getElementById('dplayer'),
            video: {
                pic: '{{$video->image}}',
                url:'{!! $video->source !!}',
                defaultQuality: 1
            },
            live: false,
            lang: 'zh-cn',
            autoplay: true,
            volume: 1,
        };

        var player = new DPlayer(options);
    </script>
@stop
