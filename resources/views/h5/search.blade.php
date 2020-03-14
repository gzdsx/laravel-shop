@extends('layouts.h5')

@section('title', '商品列表')

@section('content')
    <div class="weui-search-bar" id="searchBar">
        <form class="weui-search-bar__form">
            <div class="weui-search-bar__box">
                <i class="weui-icon-search"></i>
                <input name="q" value="{{$q or  ''}}" type="text" class="weui-search-bar__input" placeholder="搜索">
                <a href="javascript:" class="weui-icon-clear"></a>
            </div>
            <label class="weui-search-bar__label">
                <i class="weui-icon-search"></i>
                <span>搜索</span>
            </label>
        </form>
        <a href="javascript:" class="weui-search-bar__cancel-btn">取消</a>
    </div>
    <div id="app">
        <div class="weui-tab">
            <div class="weui-navbar">
                <div class="weui-navbar__item" :class="{'weui-bar__item_on':orderby=='time-desc'}" v-on:click="resetOrderby('time-desc')">新品上架</div>
                <div class="weui-navbar__item" :class="{'weui-bar__item_on':orderby=='sold-desc'}" v-on:click="resetOrderby('sold-desc')">销量优先</div>
            </div>
            <div class="weui-tab__panel">
                <div class="h5-item-list">
                    <div class="list-item" v-for="item in items" v-on:click="showItem(item)">
                        <div class="image bg-cover" :style="{'background-image':'url('+item.poster+')'}">
                            <div class="sold-out" v-if="item.stock==0"></div>
                        </div>
                        <div class="title">@{{ item.title }}</div>
                        <div class="display-flex">
                            <div class="money price">￥@{{ item.price }}</div>
                            <div class="market-price"><s>￥@{{ item.price }}</s></div>
                            <div class="flex"></div>
                            <div><div class="red-btn">新品</div></div>
                            <div><div class="red-btn">认证</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    @include('h5.tabbar')
    <script type="text/javascript">
        weui.searchBar('#searchBar');
        var app = new Vue({
            el:'#app',
            data:{
                items:[],
                catid:'{{$catid}}',
                q:'{{$q}}',
                orderby:'time-desc'
            },
            mounted:function () {
                this.loadItems();
            },
            methods:{
                loadItems:function () {
                    var $this = this;
                    $.ajax({
                        url:'/h5/search/getjson',
                        data:{
                            q:$this.q,
                            catid:$this.catid,
                            orderby:$this.orderby
                        },
                        success:function (response) {
                            $this.items = response.items;
                        },
                        complete:function (xhr) {
                            //alert(JSON.stringify(xhr));
                        }
                    });
                },
                resetOrderby:function (orderby) {
                    this.orderby = orderby;
                    this.loadItems();
                },
                showItem:function (item) {
                    window.location.href = '/h5/item/detail/'+item.itemid+'.html';
                }
            }
        });
    </script>
@stop
