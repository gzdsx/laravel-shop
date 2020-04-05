@extends('layouts.h5')

@section('title', '订单详情')

@section('content')

@stop

@section('foot')
    <script>
        var order=@json($order);
        var expresses = @json($expresses);
    </script>
    <script src="{{asset('js/h5/trade/sold/order.js?t='.time())}}"></script>
@stop
