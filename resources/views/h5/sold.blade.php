@extends('layouts.h5')

@section('title', '已售宝贝')

@section('content')
@stop

@section('foot')
    <script>window.order_id='{{$order_id}}';</script>
    <script src="{{asset('js/h5/sold.js?v='.time())}}"></script>
@stop
