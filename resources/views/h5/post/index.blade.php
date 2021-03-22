@extends('layouts.h5')

@section('title', '茶语')

@section('content')
    <div class="app" id="app">
        <ul class="h5-tabs">
            <li class="tab-item" data-id="all" v-on:click="switchCatlog(0)">
                <span class="tab-link" :class="{'active' : catid==0}">全部</span>
            </li>
            <li class="tab-item" data-id="30" v-for="catlog in catlogs" v-on:click="switchCatlog(catlog.catid)">
                <span class="tab-link" :class="{'active' : catid==catlog.catid}">@{{ catlog.name }}</span>
            </li>
        </ul>

        <ul class="h5-post-list">
            <li class="list-item" v-for="item in items" v-on:click="onClickItem(item)">
                <div class="title">@{{ item.title }}</div>
                <div class="data">
                    <div class="display-flex flex">
                        <div class="iconfont icon-time"></div>
                        <div class="text">@{{ item.formatted_time }}</div>
                    </div>
                    <div class="display-flex">
                        <div class="iconfont icon-attention"></div>
                        <div class="text">@{{ item.views }}</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
@stop

@section('foot')
    @include('h5.tabbar')
    <script>var catlogs=@json($catlogs);</script>
    <script type="text/javascript">
        var app,isLoading,isRefresh,isLoadMore;
        app = new Vue({
            el:'#app',
            data:{
                catid:0,
                items:[],
                catlogs:catlogs
            },
            mounted:function () {
                this.loadItems();
            },
            methods:{
                onClickItem:function (item) {
                    window.location.href = '{{url('h5/post/detail')}}/'+item.aid+'.html';
                },
                loadItems:function () {
                    var $this = this;
                    $.ajax({
                        url:'/h5/post/getitemlist',
                        data:{
                            catid:$this.catid,
                            offset:0,
                            count:10,
                        },
                        success:function (response) {
                            if (isLoadMore){
                                $this.items = app.items.concat(response.items);
                            } else {
                                $this.items = response.items;
                            }
                        }
                    });
                },
                switchCatlog:function (catid) {
                    this.catid = catid;
                    this.loadItems();
                }
            }
        });
    </script>
@stop
