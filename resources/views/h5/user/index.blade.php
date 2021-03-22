@extends('layouts.h5')

@section('title', '个人中心')

@section('foot')
    <script src="{{asset('static/h5/user/index.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
