@extends('layouts.error')

@section('content')
    <div class="image">
        <img src="{{asset('images/common/404.png')}}">
    </div>
    <h2>咦，页面有错误，请联系管理员！</h2>
    <div class="links">
        <a href="{{url('/')}}">返回首页</a>
        <a href="{{back()->getTargetUrl()}}">返回上一页</a>
    </div>
@stop
