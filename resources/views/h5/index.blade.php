@extends('layouts.h5')

@section('title', setting('sitename'))

@section('content')
    <router-view></router-view>
@stop

@section('foot')
    <script src="{{asset('js/h5/index.js?t='.time())}}" type="text/javascript"></script>
@endsection
