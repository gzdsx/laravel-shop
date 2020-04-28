@extends('layouts.order')

@section('title', '确认订单')

@section('content')
    <div id="app"></div>
@stop

@section('foot')
    <script type="text/javascript">
        window.items=@json($items,256);
        window.addresses=@json($addresses,256);
    </script>
    <script src="{{asset('js/lib/chunk-vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/element-ui.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/order/confirm.js?v='.time())}}" type="text/javascript"></script>
@stop
