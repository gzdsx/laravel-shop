@extends('layouts.mobile')

@section('title', '此商品已下架')

@section('content')
    <div style="position: absolute; left: 0; top: 0; right: 0; bottom: 0;">
        <div style="display: flex; flex-direction: column; height: 100%;">
            <div style="flex: 1;"></div>
            <div style="text-align: center;">
                <img src="{{asset('images/mobile/common/offsale.png')}}" style="width: 60px; height: 60px; display: inline-block;">
            </div>
            <div style="font-size: 18px; padding: 20px; font-weight: 500; text-align: center;">{{trans('mall.commodity has already gone off shelves')}}</div>
            <div style="text-align: center; padding:0; color: #00a2d4;" data-link="{{url('mobile')}}">返回首页</div>
            <div style="flex: 1"></div>
            <div style="flex: 1"></div>
        </div>
    </div>
@stop
