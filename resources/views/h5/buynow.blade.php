@extends('layouts.h5')

@section('title', '订单确认')

@section('content')

@stop

@section('foot')
    <script>
        var item_DATA = @json($item);
        var address_DATA = @json($address);
    </script>
    <script src="{{asset('js/h5/buynow.js?v='.time())}}"></script>
@stop
