@extends('layouts.h5')

@section('title', setting('sitename'))

@section('foot')
<script src="{{asset('static/h5/index/index.js?v='.config('app.version'))}}" type="text/javascript"></script>
@endsection
