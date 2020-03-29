@extends('layouts.h5')

@section('title', $item->title)

@section('content')

@stop

@section('foot')
    <script type="text/javascript">var item_DATA = @json($item);</script>
    <script src="{{asset('js/h5/item.js?v='.time())}}" type="text/javascript"></script>
@stop
