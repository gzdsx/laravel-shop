@extends('layouts.h5')

@section('title', setting('sitename'))

@section('content')
@stop

@section('foot')
    <script src="{{asset('js/h5/index.js?v='.time())}}" type="text/javascript"></script>
@endsection
