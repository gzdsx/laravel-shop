@extends('layouts.h5')

@section('title', '我的收藏')

@section('content')
    <div class="app" id="app">
        <div class="h5-tabs">
            <div class="tab-item">
                <span class="tab-link" :class="{'active':type=='item'}" v-on:click="switchTab('item')">宝贝</span>
            </div>
            <div class="tab-item">
                <span class="tab-link" :class="{'active':type=='shop'}" v-on:click="switchTab('shop')">店铺</span>
            </div>
            <div class="tab-item">
                <span class="tab-link" :class="{'active':type=='article'}" v-on:click="switchTab('article')">文章</span>
            </div>
        </div>

        <div class="collect">
            <div class="collect-item" v-for="item in items" v-on:click="showItem(item)">
                <div class="image bg-cover" :style="{'background-image':'url('+item.image+')'}"></div>
                <div class="info">
                    <div class="title">@{{ item.title }}</div>
                    <div class="flex"></div>
                    <div class="time">@{{ item.created_at }}</div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        var app = new Vue({
            el:'#app',
            data:{
                items:[],
                type:'item'
            },
            mounted:function () {
                this.loadDatasource();
            },
            methods:{
                loadDatasource:function () {
                    var self = this;
                    $.ajax({
                        url:'/h5/collect/getitemlist',
                        data:{type:self.type, offset:0, count:10},
                        success:function (response) {
                            //alert(JSON.stringify(response));
                            self.items = response.items;
                        }
                    });
                },
                switchTab:function (type) {
                    this.type = type;
                    this.loadDatasource();
                },
                showItem:function (item) {
                    if (item.datatype == 'item'){
                        window.location.href = '/h5/item/detail/'+item.dataid+'.html';
                    } else if (item.datatype == 'shop'){
                        window.location.href = '/h5/shop/viewshop/'+item.dataid+'.html';
                    } else {
                        window.location.href = '/h5/post/detail/'+item.dataid+'.html';
                    }
                }
            }
        });
    </script>
@stop
