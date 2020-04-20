@extends('layouts.admin')

@section('title', '用户管理')

@section('content')
@stop

@section('foot')
    <script src="{{asset('js/admin/user/app.js?v='.time())}}" type="text/javascript"></script>
@stop
