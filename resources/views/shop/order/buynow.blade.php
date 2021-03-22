@extends('layouts.order')

@section('title', '确认订单')

@section('content')
    <div id="app"></div>
@stop

@section('foot')
    <script type="text/javascript">
        var pageConfig = {
            item: @json($item,256),
            sku: @json($sku,256),
            quantity: {{$quantity}},
            pay_type: {{$pay_type}},
            shipping_type : {{$shipping_type}},
            addresses: @json($addresses,256)
        };
    </script>
    <script src="{{asset('js/lib/vue-chunk.js?v=1.0')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/element-ui.js')}}" type="text/javascript"></script>
    <script src="{{asset('static/order/buynow.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
