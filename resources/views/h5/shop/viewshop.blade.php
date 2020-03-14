@extends('layouts.h5')

@section('title', '店铺详情')

@section('content')
<div class="app" id="app" style="background-color: #fff;">
    <div class="shop-info">
        <div class="logo">
            <img src="{{image_url($shop['logo'])}}">
        </div>
        <div class="info">
            <h3>{{$shop['shop_name']}}</h3>
            <div class="info">
                <span>商品数量：{{$shop['itemCount']}}</span>
                <span>销量：{{$shop['total_sold']}}件</span>
            </div>
        </div>
    </div>
    <ul class="h5-tabs">
        <li class="tab-item" data-id="all"><span class="tab-link" :class="{'active' : catid==0}" v-on:click="switchTab(0)">全部</span></li>
        @foreach ($catlogs as $catlog)
            <li class="tab-item" data-id="30"><span class="tab-link" :class="{'active' : catid=='{{$catlog['catid']}}'}" v-on:click="switchTab({{$catlog['catid']}})">{{$catlog['name']}}</span></li>
        @endforeach
    </ul>
    <div class="shop-item-list">
        <div class="list-item" v-for="item in items" v-on:click="showItem(item)">
            <div class="hd">
                <div class="image bg-cover" :style="{'background-image':'url('+item.thumb+')'}">
                    <div class="sold-out" v-if="item.stock==0"></div>
                </div>
                <div class="subtitle">@{{ item.subtitle|'古茶树，口感醇厚，回甘明显' }}</div>
                <div class="baopin">
                    <span>爆品</span>
                </div>
                <div class="title">@{{ item.title }}</div>
                <div class="price">￥@{{ item.price }}</div>
            </div>
        </div>
    </div>
</div>
@stop

@section('foot')
    @include('h5.tabbar')
    <script type="text/javascript">
        var app = new Vue({
            el:'#app',
            data:{
                items:[],
                catid:0,
                shop_id: '{{$shop_id}}'
            },
            mounted:function () {
                this.loadItems();
            },
            methods:{
                loadItems:function(){
                    var $this = this;
                    $.ajax({
                        url:'/h5/shop/getitems',
                        data:{
                            catid:$this.catid,
                            shop_id: $this.shop_id
                        },
                        success:function (response) {
                            $this.items = response.items;
                        },
                        complete:function (xhr) {
                            //alert(JSON.stringify(xhr));
                        }
                    });
                },
                switchTab:function (catid) {
                    this.catid = catid;
                    this.loadItems();
                },
                showItem:function (item) {
                    window.location.href = '/h5/item/detail/'+item.itemid+'.html';
                }
            }
        });
    </script>
@stop
