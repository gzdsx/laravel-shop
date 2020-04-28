@extends('layouts.order')

@section('title', '确认订单')

@section('content')
    <div id="app"></div>
@stop

@section('foot')
    <script type="text/javascript">
        window.item=@json($item,256);
        window.sku=@json($sku,256);
        window.quantity={{$quantity}};
        window.pay_type={{$pay_type}};
        window.shipping_type={{$shipping_type}};
        window.addresses=@json($addresses,256);
    </script>
    <script src="{{asset('js/lib/chunk-vendor.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/element-ui.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/order/buynow.js?v='.time())}}" type="text/javascript"></script>
@stop
