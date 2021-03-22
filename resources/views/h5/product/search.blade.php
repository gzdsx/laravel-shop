@extends('layouts.h5')

@section('title', '产品搜索')

@section('foot')
    <script type="text/javascript">
        var pageConfig = {
            searchFields : @json(request()->except('page'))
        }
    </script>
    <script src="{{asset('static/h5/product/search.js?v='.config('app.version'))}}"></script>
@stop
