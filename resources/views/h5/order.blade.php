@extends('layouts.h5')

@section('title', '订单详情')

@section('content')

@stop

@section('foot')
    <script>var order=@json($order);</script>
    <script src="{{asset('js/h5/trade/order/index.js?v='.time())}}"></script>
@stop
