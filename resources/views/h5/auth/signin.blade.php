@extends('layouts.h5')

@section('title', '登录')

@section('foot')
    <script>window.pageConfig = {redirect:'{{$redirect}}'};</script>
    <script src="{{asset('static/h5/auth/signin.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
