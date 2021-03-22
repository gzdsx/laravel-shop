@extends('layouts.h5')

@section('title', '订单详情')

@section('foot')
    <script type="text/javascript">
        window.pageConfig.order_id = '{{request('order_id',0)}}';
    </script>
    <script src="{{asset('static/h5/sold/detail.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
