@extends('layouts.h5')

@section('title', '确认订单')

@section('foot')
    <script type="text/javascript">
        var pageConfig = {
            product:@json($product,256),
            sku:@json($sku,256),
            quantity:{{$quantity}},
            pay_type:{{$pay_type}},
            shipping_type:{{$shipping_type}}
        }
    </script>
    <script src="{{asset('static/h5/order/buynow.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
