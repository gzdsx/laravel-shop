@extends('layouts.mall')

@section('title', '宝贝搜索')

@section('styles')
    <link href="{{asset('css/search/index.css?v=1.1')}}" rel="stylesheet" type="text/css">
@stop

@section('content')
    <div class="yourpos">
        <div class="area">
            <a href="{{url('/')}}">首页</a>
            <span>></span>
            <span>宝贝搜索</span>
        </div>
    </div>
    <form method="get" id="J_FrmSearch" action="{{url('search')}}">
        <input type="hidden" name="catid" value="{{$catid}}">
        <input type="hidden" name="q" value="{{$q}}">
        <input type="hidden" name="sort" value="{{$sort}}" id="J_Sort">
    </form>
    <div class="area search-wrapper">
        <div class="main-frame">
            <div class="top-bar">
                <div class="sort-tabs">
                    <div class="tab-item" title="综合排序"><a class="J_Sort" data-value="default">综合</a></div>
                    <div class="tab-item" title="销量从高到低"><a class="J_Sort" data-value="sale-desc">销量</a></div>
                    <div class="tab-item" title="价格从低到高"><a class="J_Sort" data-value="price-asc">价格</a></div>
                </div>
                <div class="total-count float-right">总计{{$totalCount}}件商品</div>
            </div>

            <div class="item-list-grid">
                @foreach ($items as $item)
                    <div class="grid-item">
                        <div class="grid-item-content">
                            <a href="{{item_url($item->itemid)}}" target="_blank">
                                <div class="image bg-cover" style="background-image: url({{$item['thumb']}})"></div>
                            </a>
                            <div class="content">
                                <div class="sales">
                                    <div class="price">
                                        <span class="yuan">￥</span>
                                        <span class="font-weight-bold">{{$item->price}}</span>
                                    </div>
                                    <div class="sold">已售{{$item->sold}}件</div>
                                </div>
                                <div class="title"><a href="{{item_url($item->itemid)}}"
                                                      target="_blank">{{$item->title}}</a></div>
                                <div class="shop">
                                    <a href="{{shop_url($item->shop_id)}}" target="_blank">
                                        <span class="iconfont icon-shopfill"></span>
                                        <span>{{mbsubstr($item->shop->shop_name, 12)}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-wrapper">{!! $pagination !!}</div>
        </div>

        <div class="right-frame">
            <h3 class="section-title">掌柜热卖</h3>
            <ul class="item-list">
                @foreach ($hotSaleList as $item)
                    <li class="list-item">
                        <a href="{{item_url($item['itemid'])}}" target="_blank" title="{{$item['title']}}">
                            <div class="image bg-cover" style="background-image: url({{$item['thumb']}})">
                                <div class="title"><p>{{$item['title']}}</p></div>
                            </div>
                        </a>
                        <div class="sales">
                            <div class="price">
                                <span class="cny">￥</span>
                                <span class="font-weight-bold">{{$item['price']}}</span>
                            </div>
                            <div class="sold">
                                <span class="t">销量</span>
                                <span class="n">{{$item['sold']}}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <script type="text/javascript">
        $("[data-value={{$sort??'default'}}]").parent().addClass('active');
        $(".J_Sort").on('click', function () {
            var value = $(this).attr('data-value');
            $("#J_Sort").val(value);
            $("#J_FrmSearch").submit();
        });
    </script>
@stop
