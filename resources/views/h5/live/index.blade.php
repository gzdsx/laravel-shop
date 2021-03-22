@extends('layouts.h5')

@section('title', '直播')

@section('foot')
    <script src="{{asset('static/h5/live/index.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
