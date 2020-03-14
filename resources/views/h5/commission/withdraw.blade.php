@extends('layouts.h5')

@section('title', '提现记录')

@section('scripts')
    <script src="{{asset('js/moment.min.js')}}"></script>
@stop

@section('content')
    <div class="app commission" id="app">
        <div class="weui-cells margin-0">
            <div class="weui-cell record-item" v-for="item in items">
                <div class="weui-cell__bd">
                    <h3>@{{ item.card.bank }}</h3>
                    <p class="sub">@{{ item.card.account_id }}</p>
                </div>
                <div class="weui-cell__ft">
                    <p class="money">@{{ item.amount }}</p>
                    <p class="sub">@{{ moment.unix(item.created_at).format('YYYY.MM.DD HH:ss') }}</p>
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
                this.loadRecords();
            },
            methods:{
                loadRecords:function () {
                    var $this = this;
                    $.ajax({
                        url:'/h5/commission/getwithdraws',
                        success:function (response) {
                            $this.items = response.items;
                        }
                    });
                }
            }
        });
    </script>
@stop
