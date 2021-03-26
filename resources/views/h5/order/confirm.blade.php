@extends('layouts.h5')

@section('title', '确认订单')

@section('foot')
    <script type="text/javascript">
        var pageConfig = {
            items : @json($items)
        }
    </script>
    <script src="{{asset('static/h5/order/confirm.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
