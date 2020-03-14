@extends('layouts.h5')

@section('title', '我的茶树')

@section('content')
    <div class="app" id="app">
        <div class="mytrees">
            <div class="list-item" v-for="item in items">
                <div class="display-flex">
                    <div class="image bg-cover" :style="{'background-image':'url('+item.tree.image+')'}"></div>
                    <div class="content">
                        <div class="display-flex">
                            <div class="data-item border-0">
                                <h3>树龄</h3>
                                <p>@{{ item.days }}</p>
                            </div>
                            <div class="data-item">
                                <h3>已释放</h3>
                                <p>@{{ item.bubbles_released }}</p>
                            </div>
                            <div class="data-item">
                                <h3>待释放</h3>
                                <p>@{{ item.bubbles_left }}</p>
                            </div>
                            <div class="data-item">
                                <h3>能量</h3>
                                <p>@{{ item.energy }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="display-flex">
                    <div class="fontsize-14 margin-right-10">@{{ item.tree.title }}</div>
                    <div class="flex fontsize-12" style="line-height: 2;">@{{ item.created_at }}</div>
                    <div class="fontsize-12" style="line-height: 2;">已拾取: @{{ item.bubbles_picked }}</div>
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
                items:[]
            },
            mounted:function () {
                this.loadTrees();
            },
            methods:{
                loadTrees:function () {
                    var $this = this;
                    $.ajax({
                        url:'/h5/tree/gettrees',
                        success:function (response) {
                            $this.items = response.items;
                        },
                        complete:function (xhr) {
                            //alert(JSON.stringify(xhr));
                        }
                    });
                }
            }
        });
    </script>
@stop
