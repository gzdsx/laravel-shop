@extends('layouts.h5')

@section('title', '我的佣金')

@section('scripts')
    <script src="{{asset('js/moment.min.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <div class="app commission" id="app">
        <div class="commission-header">
            <div class="balance" data-link="{{url('h5/commission/withdraw')}}">{{$wallet['commission']}}</div>
            <div class="yue">余额</div>
            <div class="blank"></div>
            <div class="display-flex">
                <div class="flex-box" data-link="{{url('h5/commission/archivement')}}">
                    <p>节点业绩</p>
                    <p>统计中</p>
                </div>
                <div class="flex-box" data-link="{{url('h5/commission/archivement')}}">
                    <p>节点佣金</p>
                    <p>统计中</p>
                </div>
            </div>
        </div>
        <div class="weui-tab">
            <div class="weui-navbar">
                <div class="weui-navbar__item" data-link="{{url('h5/commission/withdraw')}}">提现记录</div>
                <div class="weui-navbar__item" data-link="{{url('h5/commission/applywithdraw')}}">余额提现</div>
            </div>
            <div class="weui-tab__panel">
                <div class="weui-cells margin-0">
                    <div class="weui-cell record-item" v-for="item in items" v-on:click="showRecord(item)">
                        <div class="weui-cell__bd">
                            <h3>@{{ item.trade_type ? '收入' : '提现' }}</h3>
                            <p class="sub">@{{ item.body }}</p>
                        </div>
                        <div class="weui-cell__ft">
                            <p class="sub">@{{ moment.unix(item.created_at).format('YYYY.MM.DD HH:ss') }}</p>
                            <p style="color: #0BB20C; font-size: 16px;" v-if="item.trade_type">+@{{ item.amount }}</p>
                            <p class="money" v-if="!item.trade_type">-@{{ item.amount }}</p>
                        </div>
                    </div>

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
                        url:'/h5/commission/getrecords',
                        success:function (response) {
                            $this.items = response.items;
                        }
                    });
                },
                showRecord:function (item) {
                    window.location.href = '/h5/commission/showrecord?id='+item.id;
                }
            }
        });
    </script>
@stop
