@extends('layouts.default')

@section('body_class','shop')
@section('title','门店')

@section('content')
    <div class="container">
        <div class="page-section">
            <div class="swiper-container">
                <div class="swiper" id="swiper">
                    <ul class="swiper-wrapper">
                        @foreach (get_block_items(1) as $item)
                            <li class="swiper-slide">
                                <a href="{{$item->url}}" target="_blank">
                                    <div class="slide-image">
                                        <img src="{{$item->image}}" alt="">
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
                    loop: true,
                    autoplay: 2500
                });
            })();
        </script>
        <div class="blank-1"></div>
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
                                        <div class="bg bg-cover"
                                             style="background-image: url({{$product->thumb}})"></div>
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
    </div>
@stop
