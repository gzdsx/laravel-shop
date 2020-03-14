@extends('layouts.mall')

@section('title', '宝贝搜索')

@section('content')
    <div class="yourpos">
        <div class="area">
            <a href="{{url('/')}}">首页</a>
            <span>></span>
            <span>宝贝搜索</span>
        </div>
    </div>
    <form method="get" id="J_FrmSearch">
        <input type="hidden" name="catid" value="{{$catid}}">
        <input type="hidden" name="q" value="{{$q}}">
        <input type="hidden" name="sort" value="{{$sort}}" id="J_sort">
    </form>
    <div class="area item-search-wrap">
        <div class="main">
            <div class="search-th">
                <span class="total-count">总计{{$totalCount}}件商品</span>
                <ul class="sort-tab">
                    <li title="综合排序"><a href="javascript:;" class="J_Ajax" data-key="sort" data-value="default">综合</a></li>
                    <li title="销量从高到低"><a class="J_Ajax" href="javascript:;" data-key="sort" data-value="sale-desc">销量</a></li>
                    <li title="价格从低到高"><a class="J_Ajax" href="javascript:;" data-key="sort" data-value="price-asc">价格</a></li>
                </ul>
            </div>
            <div class="item-list-wrap">
                <ul class="item-list">
                    @foreach ($items as $item)
                        <li>
                            <div class="item-img bg-cover" style="background-image: url({{image_url($item['thumb'])}})">
                                <a href="{{item_url($item['itemid'])}}" target="_blank" title="{{$item['title']}}"></a>
                            </div>
                            <div class="item-info">
                                <h3><a href="{{item_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a></h3>
                                <p class="brief">{{$item['subtitle']}}</p>
                                <div class="shop"><a href="{{shop_url($item['shop_id'])}}" target="_blank">{{$item['shop']['shop_name']}}</a></div>
                                <div class="dist">{{$item['shop']['city']}} {{$item['shop']['district']}}</div>
                            </div>
                            <div class="item-price">
                                <span>¥</span>
                                <strong>{{$item['price']}}</strong>
                            </div>
                            <div class="item-sold">
                                <p>{{$item['sold']}}人付款</p>
                                <p><a>{{$item['reviews']}}条评论</a></p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="align-center">{!! $pagination !!}</div>
        </div>

        <div class="frame-right">
            <div class="inner">
                <h3 class="hot-sale-title">掌柜热卖</h3>
                <ul class="hot-item-list">
                    @foreach ($hotSaleList as $item)
                        <li>
                            <div class="g-pic bg-cover" style="background-image: url({{image_url($item['thumb'])}})">
                                <div class="g-name"><p>{{$item['title']}}</p></div>
                                <a href="{{item_url($item['itemid'])}}" target="_blank" title="{{$item['title']}}"></a>
                            </div>
                            <div class="line">
                                <span class="sold">销量:{{$item['sold']}}</span>
                                <strong class="price"><span>¥</span>{{$item['price']}}</strong>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("[data-value={{$sort}}]").addClass('cur');
        $(".J_Ajax").on('click', function () {
            var key = $(this).attr('data-key');
            var value = $(this).attr('data-value');
            $("#J_"+key).val(value);
            $("#J_FrmSearch").submit();
        });
    </script>
@stop
