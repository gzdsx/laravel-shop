@extends('layouts.h5')

@section('title', '个人中心')

@section('content')
    <script>var userData=@json(auth()->user());</script>
    <script src="{{asset('js/h5/user.js?v='.time())}}" type="text/javascript"></script>
@stop
