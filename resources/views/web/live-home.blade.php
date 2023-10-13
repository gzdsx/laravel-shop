@extends('layouts.default')

@section('title', '直播')

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
                                        <img src="{{$image->image}}" class="swiper-slide-image" alt="">
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
            var swiper = new Swiper('#swiper', {
                autoplay: 2000,
                loop: true,
                pagination: '.swiper-pagination'
            });
        </script>

        <div class="page-section">
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
@stop
