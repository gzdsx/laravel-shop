@extends('layouts.shop')

@section('scripts')
    <script src="{{asset('swiper/js/swiper.min.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <div class="swiper-area">
        <div class="area">
            <div class="swiper-div">
                <div class="swiper position-relative" id="swiper" style="height: 418px;">
                    <ul class="swiper-wrapper">
                        @foreach ($slides as $item)
                            <li class="swiper-slide">
                                <a href="{{$item->url}}" target="_blank">
                                    <img src="{{$item->image}}" class="swiper-slide-image" alt="">
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
        (function () {
            var swiper = new Swiper('#swiper', {
                loop: true,
                pagination: '.swiper-pagination',
                autoplay: 2500
            });
        })();
    </script>

    <div class="color-wapper">
        <div class="area">
            <div class="bigtitle"><strong>APP下载</strong></div>
            <ul class="apps">
                <li><img src="{{asset('images/app/a1.jpg')}}"></li>
                <li><img src="{{asset('images/app/a2.jpg')}}"></li>
                <li><img src="{{asset('images/app/a3.jpg')}}"></li>
                <li><img src="{{asset('images/app/a4.jpg')}}"></li>
            </ul>
        </div>
    </div>

    <div class="color-wapper">
        <div class="bigtitle"><strong>新/品/上/市</strong></div>
        <div class="area">
            <div class="item-list-div">
                <ul>
                    @foreach ($products as $product)
                        <li>
                            <div class="thumb">
                                <a href="{{$product->url}}" target="_blank">
                                    <div class="bg bg-cover" style="background-image: url({{$product->thumb}})"></div>
                                </a>
                            </div>
                            <div class="title">
                                <a href="{{$product->url}}"
                                                  target="_blank">{{mbsubstr($product->title, 24)}}</a>
                            </div>
                            <div class="more-info">
                                <div class="price flex">￥{{$product->price}}</div>
                                <div class="sold">已抢{{format_count($product->sold)}}件</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop
