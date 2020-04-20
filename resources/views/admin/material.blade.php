@extends('layouts.admin')

@section('title', '素材管理')

@section('content')
@stop

@section('foot')
    <script>window.materialTypes=@json(__('material.types'));</script>
    <script src="{{asset('js/admin/material/app.js?v='.time())}}" type="text/javascript"></script>
@stop
