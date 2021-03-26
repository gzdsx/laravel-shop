@extends('layouts.h5')

@section('title', '确认订单')

@section('scripts')
    <script type="text/javascript">
        var pageConfig = {
            itemid : {{$itemid}},
            sku_id : {{$sku_id??0}},
            quantity : {{$quantity??1}},
            pay_type : {{$pay_type??1}},
            shipping_type : {{$shipping_type??1}}
        }
    </script>
@stop

@section('foot')
    <script src="{{asset('static/h5/order/buynow.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
