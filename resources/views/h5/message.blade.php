@extends('layouts.h5')

@section('title', $message)

@section('content')
    <div class="app">
        <div class="weui-msg">
            <div class="weui-msg__icon-area">
                <div class="weui-icon-success weui-icon_msg"></div>
            </div>
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title">{{$message}}</h2>
                <p class="weui-msg__desc">{{$tips}}</p>
            </div>
            <div class="weui-msg__opr-area">
                <div class="weui-btn-area">
                    @if ($links)
                        @foreach($links as $link)
                            <a href="{{$link[1]}}"><span class="weui-btn weui-btn_primary">{{$link[0]}}</span></a>
                        @endforeach
                    @else
                        <a href="{{$redirectTo}}"><span class="weui-btn weui-btn_primary">继续</span></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
