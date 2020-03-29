@extends('layouts.h5')

@section('title', '分类')

@section('content')

@stop

@section('foot')
    <script>var catlogs = @json($catlogs);</script>
    <script src="{{asset('js/h5/catlog.js?v='.time())}}"></script>
@stop
