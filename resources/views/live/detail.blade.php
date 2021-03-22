@extends('layouts.live')

@section('title', $live->title)

@section('content')
    <div class="live-detail">
        <div class="area">
            <div class="live-main">
                <div class="live-main-content">
                    <div class="live-player" id="dplayer"></div>
                    <div class="live-title">{{$live->title}}</div>
                    <div class="live-section-title">
                        <p>推荐直播</p>
                    </div>
                    <div class="live-list">
                        @foreach ($items as $item)
                            <div class="live-list-item">
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
            <div class="live-right"></div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        var options = {
            container: document.getElementById('dplayer'),
            video: {
                pic: '{{$live->image}}',
                quality: [
                    {
                        name: '高清',
                        url: '{!! $live->hls_hd !!}',
                        type: 'hls',
                    },
                    {
                        name: '标清',
                        url: '{!! $live->hls !!}',
                        type: 'hls',
                    },
                    {
                        name: '流畅',
                        url: '{!! $live->hls_low !!}',
                        type: 'hls',
                    },
                ],
                defaultQuality: 1
            },
            live: true,
            lang: 'zh-cn',
            autoplay: true,
            volume: 1,
        };

        var player = new DPlayer(options);
    </script>
@stop
