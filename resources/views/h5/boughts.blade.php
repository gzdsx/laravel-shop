@extends('layouts.h5')

@section('title', '我的订单')

@section('content')

@stop

@section('foot')
    <script>var tab = '{{$tab}}';</script>
    <script src="{{asset('js/h5/trade/bought/index.js?v='.time())}}"></script>
@stop
