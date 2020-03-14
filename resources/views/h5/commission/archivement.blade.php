@extends('layouts.h5')

@section('title', '我的余额')

@section('content')
    <div class="app commission">
        <div class="weui-tab">
            <div class="weui-navbar">
                <div class="weui-navbar__item ">业绩记录</div>
                <div class="weui-navbar__item weui-bar__item_on">佣金记录</div>
            </div>
            <div class="weui-tab__panel">
                <div class="weui-cells margin-0">
                    @foreach ($drawlist as $draw)
                    <div class="weui-cell record-item">
                        <div class="weui-cell__bd">
                            <h3>提现</h3>
                            <p class="sub">会员余额提现</p>
                        </div>
                        <div class="weui-cell__ft">
                            <p class="money">-{{$draw['number']}}</p>
                            <p class="sub">{{date('Y-m-d H:i:s',$draw['create_time'])}}</p>
                        </div>
                    </div>
                    @endforeach
   
                </div>
            </div>
        </div>
    </div>
@stop
