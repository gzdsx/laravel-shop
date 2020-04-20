@extends('layouts.admin')

@section('title', '页面管理')

@section('styles')
    <link rel="stylesheet" href="{{asset('kindeditor/themes/default/default.css')}}" />
    <script src="{{asset('kindeditor/kindeditor-all-min.js')}}" type="text/javascript"></script>
@stop

@section('content')
@stop

@section('foot')
    <script src="{{asset('js/admin/pages/app.js?v='.time())}}" type="text/javascript"></script>
@stop
