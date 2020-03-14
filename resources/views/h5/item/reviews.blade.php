@extends('layouts.h5')

@section('title', '商品评论')

@section('content')
    <div class="app" id="app">
        <div class="item-comment-head">
            <span v-on:click="setFilter('')">全部({{$total}})</span>
            <span v-on:click="setFilter('img')">有图({{$imgCount}})</span>
            <span v-on:click="setFilter('add')">追加({{$addCount}})</span>
        </div>
        <div class="item-comment margin-0 padding-0">
            <div class="comment-item" style="padding: 15px;" v-for="item in items">
                <div class="display-flex">
                    <img :src="item.avatar" class="avatar">
                    <div class="username">@{{ item.user ? item.user.username : '' }}</div>
                </div>
                <div class="info">
                    <p>@{{ item.created_at }}</p>
                    <p class="flex" style="height: 30px; line-height: 30px; overflow: hidden;">{{$item['title']}}</p>
                </div>
                <div class="message">
                    <span class="iconfont icon-haoping money" v-if="item.rate_type==1"></span>
                    <span class="iconfont icon-medium-review money" v-if="item.rate_type==2"></span>
                    <span class="iconfont icon-16chaping money" v-if="item.rate_type==3"></span>
                    @{{ item.message }}
                </div>

                <div class="images" v-if="item.images.length">
                    <template v-for="img in item.images">
                        <div class="bg-cover image-item" rel="fancybox" :href="img" :style="{'background-image':'url('+img+')'}"></div>
                    </template>
                </div>

                <div style="padding: 10px; background-color: #f8f8f8; border-radius: 7px; margin-top: 10px;" v-if="item.add_at">
                    <div class="message">
                        追加评论:
                        @{{ item.add_message }}
                    </div>
                    <div class="images" v-if="item.add_images.length">
                        <template v-for="img in item.add_images">
                            <div class="bg-cover image-item" rel="fancybox" :href="img" :style="{'background-image':'url('+img+')'}"></div>
                        </template>
                    </div>
                    <p style="padding-top: 5px; font-size: 14px; color: #777;">@{{ item.add_at }}</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <link  href="{{asset('fancybox/jquery.fancybox.min.css')}}" rel="stylesheet">
    <script src="{{asset('fancybox/jquery.fancybox.min.js')}}"></script>
    <script type="text/javascript">
        var app = new Vue({
            el:'#app',
            data:{
                items:[],
                filter:''
            },
            mounted:function () {
                this.loadItems();
            },
            methods:{
                loadItems:function () {
                    var $this = this;
                    $.ajax({
                        url:'/h5/item/getreviews',
                        data:{
                            itemid:'{{$itemid}}',
                            filter:$this.filter
                        },
                        success:function (response) {
                            console.log(response);
                            $this.items = response.items;
                        },
                        complete:function (xhr) {
                            //alert(JSON.stringify(xhr));
                        }
                    })
                },
                setFilter:function (filter) {
                    this.filter = filter;
                    this.loadItems();
                },
            }
        });
        $(document).on('tap', function () {
            $("[rel=fancybox]").fancybox();
        });
    </script>
@stop
