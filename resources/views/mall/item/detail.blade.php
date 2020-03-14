@extends('layouts.mall')

@section('title', $item['title'])
@section('keywords', $item['subtitle'])
@section('description', $item['subtitle'])

@section('styles')
    <link href="{{asset('css/item/detail.css')}}" type="text/css" rel="stylesheet">
@stop

@section('content')
    <div class="yourpos">
        <div class="area">
            <a href="{{url('/')}}">粗耕首页</a>
            <span> > </span>
            <a href="{{url('/item/search?catid='.$item->catid)}}">{{$item->catlog['name']}}</a>
            <span> > </span>
            <span>{{mbsubstr($item['title'], 12)}}</span>
        </div>
    </div>
    <div style="height: 10px; clear: both;"></div>
    <div class="area">
        <div class="preview-wrap">
            <div class="preview">
                <div class="zoom-div" id="zoom">
                    <!-- 正常显示的图片-->
                    @foreach ($item->images as $image)
                        @if ($loop->index==0)
                            <div class="imgbox">
                                <div class="bigimg bg-cover" data-img="{{$image['image']}}" style="background-image: url({{image_url($image['image'])}});"></div>
                                <div class="dragbox"></div>
                            </div>
                        @endif
                    @endforeach

                    <div class="previewbox">
                        <div class="previewimg bg-cover"></div>
                    </div>

                    <div class="thumbs">
                        <ul>
                            <!-- 图片显示列表 -->
                            @foreach ($item->images as $image)
                                <li data-bigimg="{{$image['image']}}">
                                    <div class="bg bg-cover" style="background-image: url({{$image['thumb']}})"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('js/lib/jquery.zoomBox.js')}}"></script>
        <div class="iteminfo-wrap">
            <form method="post" id="J_Frmbuy" action="{{url('auction/buynow')}}">
                {{csrf_field()}}
                <input type="hidden" name="itemid" value="{{$item->itemid}}">
                <h1 class="item-name">{{$item['title']}}</h1>
                <div class="item-brief">{{$item['subtitle']}}</div>
                <div class="price-wrap">
                    <div class="item-group" style="height: 60px; line-height: 60px; padding-top: 20px;">
                        <div class="label">价　　格</div>
                        <div class="info">
                            <div class="p-price">
                                <span>￥</span>
                                <strong>{{$item['price']}}</strong>
                            </div>
                        </div>
                    </div>
                    <ul class="p-stat">
                        <li>
                            <h3>0</h3>
                            <p>累计评论</p>
                        </li>
                        <li>
                            <h3>{{$item['sold']}}</h3>
                            <p>交易成功</p>
                        </li>
                    </ul>
                </div>

                <dl class="item-group">
                    <dd class="label">配送方式</dd>
                    <dt class="info">
                        <label><input type="radio" name="shipping_type" value="1" checked> 快递</label>
                        <label><input type="radio" name="shipping_type" value="2"> 物流配送</label>
                        <label><input type="radio" name="shipping_type" value="3"> 上门自取</label>
                    </dt>
                </dl>
                <div class="item-group">
                    <div class="label">购买数量</div>
                    <div class="info">
                        <div class="buy-num-wrap">
                            <span class="btn" id="decrease">-</span>
                            <input title="" type="text" class="buy-num" id="quantity" name="quantity" value="1">
                            <span class="btn" id="increase">+</span>
                        </div>
                    </div>
                </div>
                <dl class="item-group">
                    <dd class="label">支付方式</dd>
                    <dt class="info">
                        <label><input type="radio" class="radio pay_type" name="pay_type" value="1" checked="checked"> 在线支付</label>
                        <label><input type="radio" class="radio pay_type" name="pay_type" value="2"> 货到付款</label>
                    </dt>
                </dl>
                <div class="item-group">
                    <div class="info">
                        <button class="btn-lg btn-buy-now" id="btn-buy-now">立即购买</button>
                        <button class="btn-lg" id="add-to-cart"><i class="iconfont icon-cartfill"></i> <span>加入购物车</span></button>
                    </div>
                </div>
                <div class="item-group">
                    <div class="share"><i class="iconfont icon-share"></i><span>分享</span></div>
                    <div class="favorite" data-action="collection" data-id="{{$itemid}}" data-type="item">
                        <i class="iconfont icon-favor_fill_light"></i>
                        <span>收藏商品({{$item['collections']}})</span>
                    </div>
                </div>
            </form>
        </div>
        <!--goodsinfo end-->
        <div class="shopinfo-wrap">
            <div class="shop-header">
                <img src="{{asset('images/common/shop-header.png')}}">
            </div>
            <div class="shopinfo">
                <h3 title="{{$item->shop['shop_name']}}">{{mbsubstr($item->shop['shop_name'], 15)}}</h3>
                <div class="row">
                    <dl>
                        <dt>信誉</dt>
                        <dd>
                            <img src="{{asset('images/common/icon-guan.gif')}}">
                            <img src="{{asset('images/common/icon-guan.gif')}}">
                            <img src="{{asset('images/common/icon-guan.gif')}}">
                        </dd>
                    </dl>
                </div>
                <div class="row">
                    <dl>
                        <dt>掌柜</dt>
                        <dd title="{{$item->user['username']}}">{{mbsubstr($item->user['username'], 9)}}</dd>
                    </dl>
                </div>
                <div class="row">
                    <dl>
                        <dt>电话</dt>
                        <dd>{{$item->shop['phone']}}</dd>
                    </dl>
                </div>
                <div class="separate"></div>
                <div class="row" style="padding: 10px 0 20px;">
                    <a href="{{shop_url($item['shop_id'])}}" class="btn" style="margin-right: 10px;">进入店铺</a>
                    <a class="btn" data-action="addCollection" data-id="{{$item['shop_id']}}" data-type="shop">收藏店铺</a>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
    <div class="blank"></div>
    <div class="area">
        <div class="item-detail" id="detail">
            <div class="tabbar-wrap">
                <ul class="tabbar">
                    <li class="cur"><a>宝贝详情</a></li>
                    <li><a>累计评论</a></li>
                </ul>
            </div>
            <div class="detail-content">
                <ul class="item-props">
                    @foreach ($item->props as $prop)
                        <li>{{$prop['prop_name']}}: {{$prop['prop_value']}}</li>
                    @endforeach
                </ul>

                <div>{!! $item->content['content'] !!}</div>
            </div>
        </div>

        <div class="item-detail-right">
            <div class="inner">
                <h3 class="hot-sale-title">掌柜热卖</h3>
                <ul class="hot-item-list">
                    @foreach ($hotSales as $it)
                        <li>
                            <div class="g-pic bg-cover" style="background-image: url({{$item['thumb']}})">
                                <div class="g-name"><p>{{$item['title']}}</p></div>
                                <a href="{{item_url($it['itemid'])}}" target="_blank" title="{{$it['title']}}"></a>
                            </div>
                            <div class="line">
                                <span class="sold">已售出<span style="color: #f40;">{{$it['sold']}}</span>件</span>
                                <strong class="price"><span>¥</span>{{$it['price']}}</strong>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $(function () {
            $("#decrease").on('click', function () {
                var quantity = parseInt($("#quantity").val());
                if (quantity <= 1) {
                    return;
                }else {
                    quantity--;
                    $("#quantity").val(quantity);
                }
            });
            $("#increase").on('click', function () {
                var quantity = parseInt($("#quantity").val());
                quantity++;
                $("#quantity").val(quantity);
            });

            $("#btn-buy-now").on('click', function (e) {
                $("#J_Frmbuy").submit();
            });

            $("#add-to-cart").on('click', function () {
                var itemid = "{{$item->itemid}}";
                var quantity = $("#quantity").val();
                Mall.addToCart(itemid, quantity);
            });
        });
    </script>
    <script src="{{asset('js/shop_stat.js?shop_id='.$item['shop_id'])}}"></script>
@stop
