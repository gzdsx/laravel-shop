@extends('layouts.error')

@section('content')
    <div class="image">
        <img src="{{asset('images/common/404.png')}}" alt="">
    </div>
    <h2>{{$exception->getMessage() ?: '咦，你要找的页面不见了！'}}</h2>
    <div class="links">
        <a href="{{url('/')}}">返回首页</a>
        <a href="{{back()->getTargetUrl()}}">返回上一页</a>
    </div>
@stop
