@extends('layouts.error')

@section('head')
    @include('common.top')
@stop

@section('content')
    <div class="error-icon">
        <img src="{{asset('images/common/failed.png')}}">
    </div>
    <h2 style="color: #d81e06;">{{$exception->getMessage()}}</h2>
    <div class="links">
        <a href="{{url('/')}}">返回首页</a>
        <a href="{{back()->getTargetUrl()}}">返回上一页</a>
    </div>
@stop

@section('foot')
    @include('common.footer')
@stop
