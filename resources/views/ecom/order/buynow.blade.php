@extends('layouts.order')

@section('title', '确认订单')

@section('content')
    <div id="app"></div>
@stop

@section('foot')
    <script type="text/javascript">
        var pageConfig = @json($pageConfig);
    </script>
    <script src="{{asset('js/lib/vue-chunk.js?v='.config('app.version'))}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/element-ui.js')}}" type="text/javascript"></script>
    <script src="{{asset('static/order/buynow.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
