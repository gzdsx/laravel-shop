<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', '购物车')</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/cart/index.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/manifest.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js')}}" type="text/javascript"></script>
</head>
<body>
<div id="app">
    @include('common.top', [])
    <div class="header">
        <div class="area banner">
            <div class="global-logo">
                <img src="{{asset('images/common/logo.png')}}">
            </div>
            <div class="global-search-box">
                <form method="get" action="{{url('/search')}}">
                    <div class="input-box">
                        <input type="text" class="text" placeholder="商品名称" name="q" value="{{$q ?? ''}}">
                        <input type="submit" class="btn" value="搜索">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="area cart">
        <div class="cart-main">
            <form method="post" id="FrmCart" autocomplete="off" action="{{url('auction/confirmorder')}}">
                {{csrf_field()}}
                <div class="cart-table-th">
                    <table cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                        <tr>
                            <th width="100">
                                <label>
                                    <input type="checkbox" v-model="checkedAll" @change="checkAll()">
                                    <span>全选</span>
                                </label>
                            </th>
                            <th>商品信息</th>
                            <th width="100">单价</th>
                            <th width="120">数量</th>
                            <th width="100">金额</th>
                            <th width="100">操作</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <template v-if="shops.length>0">
                    <div class="cart-item" v-for="(group,index) in shops" :key="index">
                        <h3>
                            <input title="" type="checkbox" v-model="group.shop.checked" @change="checkGroup(group)">
                            <a :href="group.shop.shop_url" target="_blank">
                                <span class="iconfont icon-shopfill"></span>
                                <span>@{{ group.shop.shop_name }}</span>
                            </a>
                        </h3>
                        <div class="order-content">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tbody v-for="item in group.items" :key="item.itemid">
                                <tr>
                                    <td class="item-info">
                                        <input type="hidden" :value="item.price">
                                        <div class="chk"><input title="" type="checkbox" name="items[]" :value="item.itemid" v-model="item.checked" @change="checkItem(item)"></div>
                                        <div class="g-pic bg-cover" :style="{'background-image': 'url('+item.thumb+')'}"></div>
                                        <div class="g-info">
                                            <div class="g-name"><a target="_blank">@{{ item.title }}</a></div>
                                        </div>
                                    </td>
                                    <td width="100"></td>
                                    <td width="100">
                                        <strong>￥@{{ item.price }}</strong>
                                    </td>
                                    <td width="120">
                                        <div class="quantity-inner">
                                            <div class="act-btn decrease" @click="decrease(item)">-</div>
                                            <div class="textfield">
                                                <input title="" type="text" class="text" v-model="item.quantity">
                                            </div>
                                            <div class="act-btn increase" @click="increase(item)">+</div>
                                        </div>
                                    </td>
                                    <td width="100"><strong style="color: #f40;"></strong></td>
                                    <td width="100">
                                        <p><a href="javascript:;">移入收藏夹</a></p>
                                        <p><a href="javascript:;" @click="deleteItem(group,item)">删除</a></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
                <div class="noaccess" v-else><a href="{{url('/')}}">购物车空空也, 快去选购宝贝吧</a></div>
            </form>
        </div>
        <div class="float-bar">
            <div class="wrap">
                <div class="chk">
                    <input title="" type="checkbox" v-model="checkedAll" @change="checkAll()">
                    <span>全选</span>
                </div>
                <div class="operations">
                    <a id="multiDelete">删除</a>
                    <a id="moveToFavor">移入收藏夹</a>
                </div>
                <div class="right">
                    <div class="item-sum">已选中<strong>@{{ totalCount }}</strong>件商品</div>
                    <div class="item-sum">合计 (不含运费): <strong>@{{ totalFee }}</strong></div>
                    <div class="submit-btn" :class="{'btn-disabled':totalCount==0}" @click="settlement()">结算</div>
                </div>
            </div>
        </div>
    </div>
    @include('common.footer')
</div>
<script>var shops=@json($shops);</script>
<script src="{{asset('js/cart/entry.js')}}" type="text/javascript"></script>
</body>
</html>
