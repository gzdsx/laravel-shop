@extends('layouts.default')

@section('scripts')
    <script src="{{asset('swiper/js/swiper.min.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <div class="home">
        <div class="color-wapper headbg">
            <div class="area" style="position: relative;">
                <div class="category-panel">
                    <ul class="cat-list" id="cat-list">
                        @foreach ($catlogs as $catlog)
                            <li><a href=""><span>{{$catlog['name']}}</span></a></li>
                        @endforeach
                    </ul>
                    <div class="children-panel" id="children-panel">
                        @foreach ($catlogs as $catlog)
                            <div class="cat-group">
                                <h3><a href="" class="more">更多 >></a> {{$catlog['name']}}</h3>
                                <ul>
                                    @foreach ($catlog['children'] as $child)
                                        <li><a href="">{{$child['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-div">
                    <div class="swiper" id="swiper">
                        <ul class="swiper-wrapper">
                            @foreach ($slides as $item)
                                <li class="swiper-slide"><a href="{{$item['url']}}" target="_blank"><img src="{{image_url($item['image'])}}"></a></li>
                            @endforeach
                        </ul>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="news">
                    <div class="content">
                        <ul class="list-unstyled">
                            @foreach ($news as $item)
                                <li><a href="{{$item->url}}" target="_blank">&bull; {{$item['title']}}</a></li>
                            @endforeach
                        </ul>
                        <div class="ad"></div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                (function(){
                    new Swiper('#swiper', {loop:true,pagination:'.swiper-pagination',autoplay:2500});
                    $("#cat-list li").mouseenter(function (e) {
                        var self = this;
                        $(this).addClass('cur').siblings().removeClass('cur');
                        $("#children-panel").show();
                        $("#children-panel .cat-group").eq($(this).index()).show().siblings('.cat-group').hide();
                        $(document).mousemove(function (e) {
                            $("#children-panel").hide();
                            $(self).removeClass('cur');
                        });
                    }).mousemove(function (e) {
                        DSXUtil.stopPropagation(e);
                    });
                    $("#children-panel").mousemove(function (e) {
                        DSXUtil.stopPropagation(e);
                    });
                })();
            </script>
            <div class="blank"></div>
            <div class="area">
                <h1 class="title" style="color: #fff;">超值抢购</h1>
                <div class="item-wrapper">
                    <ul>
                        @foreach ($items as $item)
                            <li>
                                <div class="thumb">
                                    <a href="{{$item->url}}" target="_blank">
                                        <div class="bg bg-cover" style="background-image: url({{$item->thumb}})"></div>
                                    </a>
                                </div>
                                <div class="title">{{mbsubstr($item['title'], 24)}}</div>
                                <div class="more-info">
                                    <div class="price flex">￥{{$item['price']}}</div>
                                    <div class="sold">已抢{{format_count($item['sold'])}}件</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="color-wapper" style="background-color: #FFA133;">
            <div class="area">
                <h1 class="title" style="color: #fff">新品上市</h1>
                <div class="item-wrapper">
                    <ul>
                        @foreach ($items as $item)
                            <li>
                                <div class="thumb">
                                    <a href="{{$item->url}}" target="_blank">
                                        <div class="bg bg-cover" style="background-image: url({{$item->thumb}})"></div>
                                    </a>
                                </div>
                                <div class="title">{{mbsubstr($item['title'], 24)}}</div>
                                <div class="more-info flex-center"><span class="price">￥{{$item->price}}</span></div>
                                <div class="more-info flex-center">
                                    <a href="{{$item->url}}" target="_blank"><span class="btn-buynow">立即购买</span></a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="blank"></div>
                </div>
            </div>
        </div>

        <div class="color-wapper">
            <div class="area">
                <div class="bigtitle"><strong>新/鲜/水/果</strong></div>
                <div class="item-catlog-wrapper">
                    <div class="catlogs bg-cover cat-fresh-bg-1">
                        <div class="content">
                            <h3 class="title">新鲜水果</h3>
                            <div class="subtitle">应时而采，新鲜特供</div>
                            <div class="cats">
                                <a href="" target="_blank">桃子</a>
                                <a href="" target="_blank">李子</a>
                                <a href="" target="_blank">火龙果</a>
                                <a href="" target="_blank">猕猴桃</a>
                                <a href="" target="_blank">蓝莓</a>
                                <a href="" target="_blank">提子</a>
                            </div>
                            <div class="btn-more"><a href="" target="_blank">更多水果</a></div>
                        </div>
                    </div>

                    <div class="catlog-img1 bg-cover cat-fresh-bg-2">
                    </div>
                    <div class="catlog-img2 cat-fresh-bg-3">
                    </div>
                </div>
                <div class="item-wrapper">
                    <ul>
                        @foreach ($items as $item)
                            <li>
                                <div class="thumb">
                                    <a href="{{$item->url}}" target="_blank">
                                        <div class="bg bg-cover" style="background-image: url({{$item->thumb}})"></div>
                                    </a>
                                </div>
                                <div class="title">{{mbsubstr($item['title'], 24)}}</div>
                                <div class="more-info"><span class="price">￥{{$item->price}}</span></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="color-wapper">
            <div class="area">
                <div class="bigtitle"><strong>新/鲜/蔬/菜</strong></div>
                <div class="item-catlog-wrapper">
                    <div class="catlogs bg-cover cat-fresh-bg-1">
                        <div class="content">
                            <h3 class="title">新鲜蔬菜</h3>
                            <div class="subtitle">应时而采，新鲜特供</div>
                            <div class="cats">
                                <a href="" target="_blank">白菜</a>
                                <a href="" target="_blank">菠菜</a>
                                <a href="" target="_blank">油菜</a>
                                <a href="" target="_blank">玉米</a>
                                <a href="" target="_blank">黄瓜</a>
                                <a href="" target="_blank">茄子</a>
                            </div>
                            <div class="btn-more"><a href="" target="_blank">更多蔬菜</a></div>
                        </div>
                    </div>

                    <div class="catlog-img1 bg-cover cat-vegetables-bg-2">

                    </div>
                    <div class="catlog-img2 bg-cover cat-vegetables-bg-3">

                    </div>
                </div>
                <div class="item-wrapper">
                    <ul>
                        @foreach ($items as $item)
                            <li>
                                <div class="thumb">
                                    <a href="{{$item->url}}" target="_blank">
                                        <div class="bg bg-cover" style="background-image: url({{$item->thumb}})"></div>
                                    </a>
                                </div>
                                <div class="title">{{mbsubstr($item['title'], 24)}}</div>
                                <div class="more-info"><span class="price">￥{{$item->price}}</span></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="color-wapper">
            <div class="area">
                <div class="bigtitle"><strong>粮/油/副/食</strong></div>
                <div class="item-catlog-wrapper">
                    <div class="catlogs bg-cover cat-fushi-bg-1">
                        <div class="content">
                            <h3 class="title">粮油副食</h3>
                            <div class="subtitle">肉香四溢，大快朵颐</div>
                            <div class="cats">
                                <a href="" target="_blank">面食</a>
                                <a href="" target="_blank">五谷杂粮</a>
                                <a href="" target="_blank">大米</a>
                                <a href="" target="_blank">方便速食</a>
                                <a href="" target="_blank">食用油</a>
                                <a href="" target="_blank">南北干货</a>
                            </div>
                            <div class="btn-more"><a href="" target="_blank" style="color: #F27961;">更多食品</a></div>
                        </div>
                    </div>

                    <div class="catlog-img1 bg-cover cat-fushi-bg-2">

                    </div>
                    <div class="catlog-img2 cat-fushi-bg-3">

                    </div>
                </div>
                <div class="item-wrapper">
                    <ul>
                        @foreach ($items as $item)
                            <li>
                                <div class="thumb">
                                    <a href="{{$item->url}}" target="_blank">
                                        <div class="bg bg-cover" style="background-image: url({{$item->thumb}})"></div>
                                    </a>
                                </div>
                                <div class="title">{{mbsubstr($item['title'], 24)}}</div>
                                <div class="more-info"><span class="price">￥{{$item->price}}</span></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
