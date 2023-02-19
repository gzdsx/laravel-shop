@extends('layouts.shop')

@section('title', $product->title)

@section('content')
    <div class="item-detail">
        <div class="area">
            <div class="frame-main">
                <div class="frame-main-content">
                    <form method="get" id="Form" autocomplete="off" action="{{url('order/buynow')}}">
                        <input type="hidden" name="itemid" value="{{$product->itemid}}">
                        <input type="hidden" name="sku_id" value="" id="sku_id">
                        <div class="flex-row">
                            <div class="preview-wrapper">
                                <div class="preview">
                                    <div class="zoom-div" id="zoom">
                                        <!-- 正常显示的图片-->
                                        @foreach ($product->images as $image)
                                            @if ($loop->index==0)
                                                <div class="imgbox">
                                                    <div class="bigimg bg-cover" data-img="{{$image->image}}"
                                                         style="background-image: url({{$image->image}});"></div>
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
                                                @foreach ($product->images as $image)
                                                    <li data-bigimg="{{$image->image}}">
                                                        <div class="bg bg-cover"
                                                             style="background-image: url({{$image->thumb}})"></div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-info">
                                <h1 class="item-name">{{$product->title}}</h1>
                                <div class="item-brief">{{$product->subtitle}}</div>
                                <div class="item-price-wrapper">
                                    <div class="item-price">
                                        <label>价　格</label>
                                        <span>￥</span>
                                        <strong id="price">{{$product->price}}</strong>
                                    </div>
                                    <ul class="item-stat">
                                        <li>
                                            <h3>{{$product->reviews}}</h3>
                                            <p>累计评论</p>
                                        </li>
                                        <li>
                                            <h3>{{$product->sold}}</h3>
                                            <p>累计销售</p>
                                        </li>
                                    </ul>
                                </div>
                                @if ($product->attrs)
                                    @foreach ($product->attrs as $attr)
                                        <dl class="item-dl">
                                            <dd class="dd">{{$attr['attr_title']}}</dd>
                                            <dt class="dt">
                                                <ul class="item-attrs">
                                                    @foreach ($attr['attr_values'] as $val)
                                                        <li data-value="{{$val['attr_id']}}">
                                                            <a>{{$val['attr_value']}}</a>
                                                            <i></i>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </dt>
                                        </dl>
                                    @endforeach
                                @endif
                                <dl class="item-dl">
                                    <dd class="dd">购买数量</dd>
                                    <dt class="dt flex-row align-items-center">
                                        <div class="input-number">
                                            <span class="input-btn" id="decrease">-</span>
                                            <span class="flex">
                                        <input class="input-text" title="" type="number" id="quantity" name="quantity"
                                               value="1">
                                    </span>
                                            <span class="input-btn" id="increase">+</span>
                                        </div>
                                        <div class="flex-fill">
                                            <div>库存:<span id="stock">{{$product->stock-1}}</span>件</div>
                                        </div>
                                    </dt>
                                </dl>
                                <dl class="item-dl">
                                    <dd class="dd">配送方式</dd>
                                    <dt class="dt">
                                        <label><input type="radio" name="shipping_type" value="1" class="radio" checked> 快递</label>
                                        <label><input type="radio" name="shipping_type" value="2" class="radio"> 上门自取</label>
                                    </dt>
                                </dl>
                                <dl class="item-dl">
                                    <dd class="dd">付款方式</dd>
                                    <dt class="dt">
                                        <label><input type="radio" class="radio pay_type" name="pay_type" value="1"
                                                      checked="checked"> 在线支付</label>
                                        <label><input type="radio" class="radio pay_type" name="pay_type" value="2">
                                            货到付款</label>
                                    </dt>
                                </dl>
                                @if ($product->on_sale)
                                    <div class="item-dl">
                                        <div class="flex-row">
                                            <button class="btn-sku btn-buy" id="btn-buy" type="button" role="button">
                                                <span>立即购买</span>
                                            </button>
                                            <button class="btn-sku btn-basket" id="btn-basket" type="button"
                                                    role="button">
                                                <i class="iconfont icon-cartfill"></i>
                                                <span>加入购物车</span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                <div class="item-dl">
                                    <div class="share" style="margin-right: 20px;">
                                        <i class="iconfont icon-share"></i>
                                        <span>分享</span>
                                    </div>
                                    <div class="favorite" onclick="collectProduct({{$product->itemid}})">
                                        <i class="iconfont icon-favor_fill_light"></i>
                                        <span>收藏商品({{$product->collections}})</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="blank"></div>
                    {{--文章详情--}}
                    <div class="detail-content">
                        <div class="col-sidebar">
                            <div class="hot-sale-wrapper">
                                <div class="hot-sale-inner">
                                    <h3 class="hot-sale-title">掌柜热卖</h3>
                                    <ul>
                                        @foreach ($hotSales as $it)
                                            <li>
                                                <div class="bg-cover g-pic"
                                                     style="background-image: url({{$it->thumb}})">
                                                    <a href="{{$it->url}}" title="{{$it->title}}"></a>
                                                    <div class="g-name"><p>{{$it->title}}</p></div>
                                                </div>
                                                <div class="more-info">
                                                    <strong class="price"><span>¥</span>{{$it->price}}</strong>
                                                    <span class="sold">已售出<span
                                                                style="color: #f40;">{{$it->sold}}</span>件</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-main">
                            <ul class="detail-content-tabs">
                                <li class="active"><a>宝贝详情</a></li>
                                <li><a>商品评价</a></li>
                            </ul>
                            <div class="detail-content-contents">
                                <div class="content-block">
                                    <div class="item-content">
                                        <ul class="item-props">
                                            @foreach ($product->props as $prop)
                                                <li>{{$prop['prop_name']}}: {{$prop['prop_value']}}</li>
                                            @endforeach
                                        </ul>
                                        <div>{!! $product->content['content'] !!}</div>
                                    </div>
                                </div>
                                <div class="content-block hidden">
                                    <div class="content-nav">
                                        <h3>全部评价（{{$reviews->total()}}）</h3>
                                    </div>
                                    <div class="item-comments">
                                        @foreach ($reviews as $review)
                                            @if ($review->user)
                                                <div class="comment-item">
                                                    <div class="face">
                                                        <img src="{{$review->user->avatar}}" alt="">
                                                    </div>
                                                    <div class="info">
                                                        <div class="flex-row">
                                                            <div class="username flex-fill">{{$review->user->username}}</div>
                                                            <div class="pubtime">{{$review->created_at}}</div>
                                                        </div>
                                                        <div class="message">{{$review->message??'默认好评'}}</div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="flex-row justify-content-end">{{$reviews->render()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="frame-right">

            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('lib/jquery.zoombox.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        window.item =@json($product,JSON_UNESCAPED_UNICODE);
        function collectProduct(itemid) {
            $.post('/api/product/collect/create', {itemid: itemid});
        }
    </script>
@stop

@section('foot')
    <script type="text/javascript">
        (function () {
            var price = item.price;
            var stock = item.stock;
            var priceEl = $("#price");
            var stockEl = $("#stock");
            var skuIdEl = $("#sku_id");
            var quantityEl = $("#quantity");
            var decreaseEl = $("#decrease");
            var increaseEl = $("#increase");
            var quantity = quantityEl.val();
            quantityEl.on('change', function () {
                var val = $(this).val();
                if (val < 1) {
                    val = 1;
                }

                if (val > stock) {
                    DSXUI.showToast('没有这么多了，亲');
                    return false;
                }

                quantity = val;
                setStock();
            });
            decreaseEl.on('click', function () {
                if (quantity > 1) {
                    quantityEl.val(--quantity);
                }
                setStock();
                $(this).prop('disabled', quantity > 1);
            });
            increaseEl.on('click', function () {
                if (quantity > stock) {
                    DSXUI.showToast('不能再多了，亲');
                    return false;
                }
                quantityEl.val(++quantity);
                setStock();
            });

            $(".item-attrs li").on('click', function () {
                $(this).addClass('selected').siblings().removeClass('selected');
                setSku();
            });

            $("#btn-buy").on('click', function () {
                if (item.skus.length > 0) {
                    if (!skuIdEl.val()) {
                        DSXUI.showToast('请选择产品型号');
                        return false;
                    }
                }
                $("#Form").submit();
            });

            $("#btn-basket").on('click', function () {
                if (item.skus.length > 0) {
                    if (!skuIdEl.val()) {
                        DSXUI.showToast('请选择产品型号');
                        return false;
                    }
                }
                $.post('/webapi/cart/create', {
                    itemid: item.itemid,
                    quantity: quantity,
                    sku_id: skuIdEl.val()
                }, function (response) {
                    if (response.errcode) {
                        if (response.errmsg === 'Unauthenticated.') {
                            window.location.href = '/login';
                        } else {
                            DSXUI.showToast(response.errmsg);
                        }

                    } else {
                        DSXUI.showToast('已成功加入购物车');
                    }
                });
            });

            function setSku() {
                var flag = true;
                var props = [];
                $(".item-attrs").each(function (i, o) {
                    if ($(o).find('li.selected').length === 0) {
                        flag = false;
                        return false;
                    } else {
                        props.push($(o).find('.selected').attr('data-value'));
                    }
                });

                if (flag) {
                    var key = props.join('-');
                    var sku;
                    $(item.skus).each(function (i, s) {
                        if (key === s.properties) {
                            sku = s;
                        }
                    });
                    if (sku) {
                        price = sku.price;
                        stock = sku.stock;
                        priceEl.html(price);
                        skuIdEl.val(sku.sku_id);
                        setStock();
                    }
                }
            }

            function setStock() {
                stockEl.html(stock - quantity);
            }
        })();

        (function () {
            $(".detail-content-tabs li").on('click', function () {
                $(this).addClass('active').siblings().removeClass();
                $(".detail-content-contents .content-block").eq($(this).index()).removeClass('hidden').siblings().addClass('hidden');
            });
            $.ajax('/item/reviews', {
                success: function (c) {
                    $("#reviews").html(c);
                }
            })
        })();
    </script>
@stop
