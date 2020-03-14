@extends('layouts.h5')

@section('title', '全部分类')

@section('content')
    <div class="app" id="app">
        <div class="left-category-list">
            <div class="list-item" v-for="catlog in categories" :class="{active:catlog.catid==catid}" v-on:click="switchCatlog(catlog)">@{{ catlog.name }}</div>
        </div>
        <div class="category-list-view">
            <ul>
                <li v-for="item in items" v-on:click="onClickCatlog(item)">
                    <div class="hd">
                        <div class="image bg-cover" :style="{'background-image':'url('+item.icon+')'}"></div>
                        <div class="title">@{{ item.name }}</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@stop

@section('foot')
    @include('h5.tabbar')
    <script>var categories = @json($categories);</script>
    <script type="text/javascript">
        var app = new Vue({
            el:'#app',
            data:{
                items:[],
                categories:categories,
                catid:categories[0].catid
            },
            mounted:function () {
                this.loadCatlogs();
            },
            methods:{
                onClickCatlog:function (catlog) {
                    window.location.href = '{{url('h5/search?catid=')}}'+catlog.catid;
                },
                switchCatlog:function (catlog) {
                    //alert(JSON.stringify(catlog));
                    this.catid = catlog.catid;
                    this.loadCatlogs();
                },
                loadCatlogs:function () {
                    var $this = this;
                    $.ajax({
                        url:'/h5/category/getjson?fid='+$this.catid,
                        success:function (response) {
                            $this.items = response.items;
                        }
                    });
                }
            }
        });
    </script>
@stop
