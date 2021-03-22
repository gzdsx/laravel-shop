@extends('layouts.h5')

@section('title', '宝贝详情')

@section('foot')
    <script type="text/javascript">
        var pageConfig = {
            itemid: '{{$itemid}}'
        }
    </script>
    <script src="{{asset('static/h5/product/detail.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
