@extends('layouts.h5')

@section('title', '帮助与反馈')

@section('content')

@stop

@section('foot')
    <script src="{{asset('js/h5/feedback/index.js?v='.time())}}"></script>
@stop
