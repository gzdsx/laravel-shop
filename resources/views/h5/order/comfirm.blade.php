@extends('layouts.h5')

@section('title', '订单确认')

@section('content')

@stop

@section('foot')
    <script>
        var $confirmData = {
            items: @json($items),
            address: @json($address)
        };
    </script>
    <script src="{{asset('js/h5/order/confirm/index.js?v='.time())}}"></script>
@stop
