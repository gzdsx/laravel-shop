@extends('layouts.admin')

@section('title', '商品管理')

@section('content')

@stop

@section('foot')
    <script src="{{asset('js/admin/item/list.js?v='.time())}}" type="text/javascript"></script>
@stop
