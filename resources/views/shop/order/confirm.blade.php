@extends('layouts.order')

@section('title', '确认订单')

@section('content')
    <div id="app"></div>
@stop

@section('foot')
    <script type="text/javascript">
        window.addresses=@json($addresses,256);
        var pageConfig = {
            items: @json($items,256),
            addresses: @json($addresses,256)
        }
    </script>
    <script src="{{asset('js/lib/vue-chunk.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/element-ui.js')}}" type="text/javascript"></script>
    <script src="{{asset('static/order/confirm.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
