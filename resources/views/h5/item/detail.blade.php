@extends('layouts.h5')

@section('title', '宝贝详情')

@section('scripts')
    <script type="text/javascript" src="{{asset('swiper/js/swiper.min.js')}}"></script>
@stop

@section('content')
    <div class="app">
        <div class="swiper-div" style="padding-top: 80%;">
            <div class="swiper" id="swiper">
                <ul class="swiper-wrapper">
                    @foreach($images as $img)
                        @if ($img['image'] != $item['poster'])
                            <li class="swiper-slide">
                                <div class="bg bg-cover" style="background-image: url({{image_url($img['image'])}})"></div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <script type="text/javascript">
            (function(){
                var swiper = new Swiper('#swiper', {loop:true,pagination:'.swiper-pagination',autoplay:2500});
            })();
        </script>
        <div class="item-info">
            <div class="title">{{$item['title']}}</div>
            @if ($item['subtitle'])
                <div class="subtitle">{{$item['subtitle']}}</div>
            @endif
            <div class="display-flex">
                <div class="price money">￥{{$item['price']}}</div>
                <div class="market-price"><s>￥{{$item['price']}}</s></div>
            </div>
            <div class="data">
                <div class="text">包邮</div>
                <div class="text align-center">已售{{$item['sold']}}</div>
                <div class="text align-right">{{$shop['province']}}{{$shop['city']}}</div>
            </div>
        </div>
        @if ($reviews)
            <div class="item-comment">
                <div class="weui-cells">
                    <a class="weui-cell weui-cell_access" href="javascript:;">
                        <div class="weui-cell__bd">
                            <p>商品评论({{$reviews->count()}})</p>
                        </div>
                        <div class="weui-cell__ft" data-link="{{url('h5/item/reviews?itemid='.$itemid)}}">查看全部</div>
                    </a>
                </div>
                <div style="padding: 0 15px;">
                    @foreach ($reviews as $review)
                        <div class="comment-item">
                            <div class="display-flex">
                                <img src="{{avatar($review['uid'])}}" class="avatar">
                                <div class="phone">{{$review['user']['username']}}</div>
                            </div>
                            <div class="info">
                                <p>{{@date('Y.m.d H:i', $review->created_at)}}</p>
                                <p class="flex" style="height: 30px; line-height: 30px; overflow: hidden;">{{$item['title']}}</p>
                            </div>
                            <div class="message">
                                @if ($review['rate_type'] == 1)
                                    <span class="iconfont icon-haoping money"></span>
                                @elseif($review['rate_type'] == 2)
                                    <span class="iconfont icon-medium-review money"></span>
                                @else
                                    <span class="iconfont icon-16chaping money"></span>
                                @endif
                                {{$review['message']}}
                            </div>

                            @if ($review['images'])
                                <div class="images">
                                    @foreach($review['images'] as $img)
                                        <a data-fancybox="gallery" href="{{image_url($img)}}">
                                            <div class="bg-cover image-item" style="background-image: url({{image_url($img)}})"></div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            @if ($review['add_at'])
                                <div style="padding: 10px; background-color: #f8f8f8; border-radius: 7px; margin-top: 10px;">
                                    <div class="message">
                                        追加评论:
                                        {{$review['add_message']}}
                                    </div>
                                    @if ($review['add_images'])
                                        <div class="images">
                                            @foreach($review['add_images'] as $img)
                                                <a data-fancybox="gallery" href="{{image_url($img)}}">
                                                    <div class="bg-cover image-item" style="background-image: url({{image_url($img)}})"></div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                    <p style="padding-top: 5px; font-size: 14px; color: #777;">{{@date('Y.m.d H.i', $review['add_at'])}}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="item-shop-info" data-link="{{h5_shop_url($shop['shop_id'])}}">
            <div class="flex display-flex">
                <div class="logo"><img src="{{image_url($shop['logo'])}}"></div>
                <div class="flex" style="padding-top: 10px;">
                    <h3 class="fontsize-14">{{$shop['shop_name']}}</h3>
                    <p class="fontsize-14">销量:{{$shop['total_sold']}}</p>
                </div>

            </div>
            <div class="data">
                <div class="data-item">
                    <div class="hd border-0">
                        <div>描述</div>
                        <p>
                            <span>{{round($product_score, 1)}}</span>
                            <span class="iconfont{{$product_score>4.5 ? ' icon-xiangshang4' : ' icon-xiangxia4'}}"></span>
                        </p>
                    </div>
                </div>
                <div class="data-item">
                    <div class="hd">
                        <div>物流</div>
                        <p>
                            <span>{{round($wuliu_score, 1)}}</span>
                            <span class="iconfont{{$wuliu_score>4.5 ? ' icon-xiangshang4' : ' icon-xiangxia4'}}"></span>
                        </p>
                    </div>
                </div>
                <div class="data-item">
                    <div class="hd">
                        <div>服务</div>
                        <p>
                            <span>{{round($service_score, 1)}}</span>
                            <span class="iconfont{{$service_score>4.5 ? ' icon-xiangshang4' : ' icon-xiangxia4'}}"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="item-content">
            <div class="weui-cells">
                <a class="weui-cell weui-cell_access" href="javascript:;">
                    <div class="weui-cell__bd">
                        <p>商品详情</p>
                    </div>
                </a>
            </div>
            <div class="content">{!! $content['content'] !!}</div>
        </div>
    </div>
@stop

@section('foot')
    <div class="tabbar">
        <div class="bar">
            <div class="item-min-actions">
                <div class="action">
                    <a href="tel:{{$shop['phone']}}">
                        <img src="{{asset('images/h5/icons/kefu.png')}}" class="i">
                        <div class="t">客服</div>
                    </a>
                </div>
                <div class="action" data-link="{{url('h5/cart')}}">
                    <img src="{{asset('images/h5/icons/cart.png')}}" class="i">
                    <div class="t">购物车</div>
                </div>
                <div class="action" id="favorite">
                    <img src="{{asset('images/h5/icons/shoucang.png')}}" class="i">
                    <div class="t">收藏</div>
                </div>
            </div>
            <div class="item-auction-button" id="addToCart">加入购物车</div>
            <div class="item-auction-button" id="buyNow" style="background-color:#C7161E;">立即购买</div>
        </div>
    </div>

    <div class="dsxui-overlayer" id="overlayer" style="display: none;"></div>
    <div class="buybox" id="buybox">
        <form method="post" id="buyForm" action="{{url('h5/auction/buynow')}}">
            {{csrf_field()}}
            <input type="hidden" name="itemid" value="{{$itemid}}">
            <div class="content">
                <div class="close" id="close">×</div>
                <div class="item-info">
                    <div class="image bg-cover" style="background-image: url({{image_url($item['thumb'])}})"></div>
                    <div class="con">
                        <div class="title">{{$item['title']}}</div>
                        <div class="flex"></div>
                        <div class="price">{{$item['price']}}</div>
                        <div class="stock">库存:@{{ stock }}</div>
                    </div>
                </div>

                <div class="actions">
                    <div class="group">
                        <div class="cell-left">购买数量</div>
                        <div class="cell-right">
                            <div class="quantity-box">
                                <div class="button" v-on:click="decrease()">-</div>
                                <input type="text" title="" name="quantity" class="text" :value="quantity">
                                <div class="button" v-on:click="increase()">+</div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="submit-btn" id="submitButton">确定</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        var stock = parseInt('{{$item['stock']}}');
        var buybox = new Vue({
            el:'#buybox',
            data:{
                quantity:1,
                stock:{{$item['stock']}},
            },
            methods:{
                increase:function () {
                    this.quantity++;
                    if (this.quantity > this.stock){
                        this.quantity = this.stock;
                    }

                    this.stock--;
                    if (this.stock < 0) {
                        this.stock = 0
                    }
                },
                decrease:function () {
                    if (this.quantity > 1) {
                        this.quantity--;
                        this.stock++;
                    }
                }
            }
        });

        function showModalView(callback) {
            $("#overlayer").show();
            $("#buybox").animate({bottom:0}, 'fast');
            if (callback) callback();
        }

        $("#addToCart").on('tap', function () {
            showModalView(function () {
                $("#submitButton").on('tap', function () {
                    if (stock < 1)
                    {
                        weui.toast('商品库存不足');
                        return false;
                    }

                    if (buybox.quantity < 1)
                    {
                        weui.toast('数量不能小于1');
                        return false;
                    }
                    $.ajax({
                        type:'POST',
                        data: {itemid:'{{$itemid}}', quantity:buybox.quantity},
                        url: '/h5/cart/add',
                        success:function (response) {
                            $("#buybox").animate({'bottom':'-100%'}, 'fast', function () {
                                $("#overlayer").hide();
                                DSXUI.showToast('已成功加入购物车');
                            });
                        }
                    });
                });
            });
        });

        $("#buyNow").on('tap', function () {
            showModalView(function () {
                $("#submitButton").on('tap', function () {
                    if (stock < 1)
                    {
                        weui.toast('商品库存不足');
                        return false;
                    }

                    if (buybox.quantity < 1)
                    {
                        weui.toast('数量不能小于1');
                        return false;
                    }
                    $("#buyForm").submit();
                });
            });
        });
        $("#buybox").on('tap', function (e) {
            DSXUtil.stopPropagation(e);
        });
        $("#close").on('tap', function () {
            $("#buybox").animate({'bottom':'-100%'}, 'fast', function () {
                $("#overlayer").hide();
            });
        });
        $("#favorite").on('tap', function () {
            $.ajax({
                url:'/h5/collect/add',
                type:'POST',
                data:{dataid:'{{$itemid}}', datatype:'item'},
                success:function () {
                    weui.toast('收藏成功');
                }
            });
        });
    </script>
    <link  href="{{asset('fancybox/jquery.fancybox.min.css')}}" rel="stylesheet">
    <script src="{{asset('fancybox/jquery.fancybox.min.js')}}"></script>
@stop
