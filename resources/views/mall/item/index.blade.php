@extends('layouts.mobile')

@section('title', $catlog['name'])

@section('content')
    <ul class="item-listview" id="app">
        <li v-for="item in items" v-on:click="onClickItem(item)">
            <div class="image bg-cover" :style="{'background-image' : 'url('+item.thumb+')'}"></div>
            <div class="content">
                <div class="title">@{{item.title}}</div>
                <div class="flex"></div>
                <div class="price">
                    <strong>@{{item.price}}</strong>
                    <span>已售@{{ item.sold }}</span>
                </div>
                <div class="location">
                    <div class="seller">@{{ item.shop.shop_name }}</div>
                    <span>@{{ item.shop.city }} @{{ item.shop.district }}</span>
                </div>
            </div>
        </li>
    </ul>
    <script type="text/javascript">
        (function () {
            var offset = 0;
            var isLoading = false;
            var loadMoreAble = false;
            var loadDatasource = function (callback) {
                isLoading = true;
                $.ajax({
                    url:'/mobile/catlog/getjson',
                    data:{offset:offset, count:10, catid:'{{$catid}}'},
                    success:function (response) {
                        isLoading = false;
                        loadMoreAble = response.items.length === 10;
                        if (callback) callback(response);
                    }
                });
            };
            var vm = new Vue({
                el:'#app',
                data:{
                    items:[]
                },
                mounted:function () {
                    var self = this;
                    loadDatasource(function (response) {
                        var items = self.items;
                        self.items = items.concat(response.items);
                    });
                },
                methods:{
                    onClickItem:function (item) {
                        window.location.href = item.url;
                    }
                }
            });
            onDocumentReachBottom(function () {
                if (isLoading) return;
                if (!loadMoreAble) return;
                offset+= 10;
                loadDatasource(function (response) {
                    vm.items = vm.items.concat(response.items);
                });
            });
        })();
    </script>
@stop
