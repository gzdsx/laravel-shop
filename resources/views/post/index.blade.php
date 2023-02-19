@extends('layouts.post')

@section('title', $category ? $category->name : '资讯')

@section('scripts')
    <script src="{{asset('swiper/js/swiper.min.js')}}"></script>
@stop

@section('content')
    <div class="home-swiper-wrapper">
        <div class="area">
            <div class="swiper-div overflow-hidden">
                <div class="swiper position-relative" id="swiper">
                    <ul class="swiper-wrapper">
                        @foreach ($images as $image)
                            <li class="swiper-slide">
                                <a href="{{$image->url}}">
                                    <img src="{{$image->image}}" class="swiper-slide-image" alt="">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="swiper-pagination"></div>
                </div>
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
    <div class="area" style="padding: 20px 0;">
        <div class="flex-row">
            <div class="home-main">
                <ul class="categories">
                    <li><a href="{{url('post')}}" class="{{$cate_id ? '' : 'active'}}">推荐</a></li>
                    @foreach ($categories as $category)
                        <li><a href="{{$category->url}}"
                               class="{{$cate_id==$category->cate_id ? 'active' : ''}}">{{$category->cate_name}}</a></li>
                    @endforeach
                </ul>
                <div class="post-list">
                    @foreach ($items as $item)
                        <div class="post-list-item">
                            @if ($item->image)
                                <div class="thumb">
                                    <a href="{{$item->url}}" target="_blank">
                                        <img src="{{$item->image}}" alt="{{$item->title}}">
                                    </a>
                                </div>
                            @endif
                            <div class="flex-fill overflow-hidden position-relative">
                                <div class="title"><a href="{{$item->url}}" target="_blank">{{$item->title}}</a></div>
                                <p>{!! $item->summary !!}</p>
                                <div class="bot">
                                    <span>{{$item->from}} · {{$item->views}}浏览 · {{$item->created_at}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination-wrapper">
                    <div class="flex-fill"></div>
                    {{$items->render()}}
                    <div class="flex-fill"></div>
                </div>
            </div>
            <div class="post-right">
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
