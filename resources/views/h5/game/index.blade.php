@extends('layouts.h5')

@section('title', '茶多分')

@section('content')
    <div class="game" id="game">
        <div class="left-top">
            <div class="button-item" data-link="{{url('h5/tree')}}">
                <img src="{{asset('images/h5/icons/cha.png')}}" class="icon">
                <div class="text">茶多分{{$wallet['points']}}</div>
            </div>
            <div class="button-item" data-link="{{url('h5/tree')}}">
                <img src="{{asset('images/h5/icons/libao.png')}}" class="icon">
                <div class="text">礼包{{$treeCount}}</div>
            </div>
            {{--<div class="button-item" data-link="{{url('h5/tree')}}">--}}
                {{--<img src="{{asset('images/h5/icons/taiyang.png')}}" class="icon">--}}
                {{--<div class="text">能量{{$energy}}</div>--}}
            {{--</div>--}}
        </div>

        <div class="right-top">
            <div class="button-item" data-link="{{h5_page_url(46)}}">
                <div class="text">了解证品荟</div>
            </div>
        </div>

        <div class="right-bottom">
            <div class="button-item" data-link="{{url('h5/invite')}}">
                <img src="{{asset('images/h5/icons/yaoqinghaoyou.png')}}" class="icon">
                <div class="text">邀请好友</div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script src="{{asset('js/h5/game.js')}}"></script>
@stop
