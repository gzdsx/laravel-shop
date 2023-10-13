@extends('layouts.default')

@section('title', '视频')
@section('body_class', 'video')

@section('content')
    <div class="container">
        <div class="page-section">
            <div class="swiper-container">
                <div class="swiper" id="swiper">
                    <ul class="swiper-wrapper">
                        @foreach (get_block_items(1) as $image)
                            <li class="swiper-slide">
                                <a href="{{$image->url}}">
                                    <div class="slide-image">
                                        <img src="{{$image->image}}" alt="">
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            (function () {
                new Swiper('#swiper', {
                    autoplay: true,
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination'
                    }
                });
            })();
        </script>

        <div class="page-section">
            <div class="video-section-title">
                <p>最新视频</p>
            </div>
            <div class="video-list">
                @foreach ($videos as $vod)
                    <div class="video-list-item">
                        <div class="list-item-bg">
                            <div class="thumb">
                                <a href="{{$vod->url}}"><img src="{{$vod->image}}" alt=""></a>
                            </div>
                            <div class="meta">
                                <div class="title">{{$vod->title}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop