@extends('layouts.h5')

@section('title', '购物车')

@section('foot')
<script src="{{asset('static/h5/cart/index.js?v='.config('app.version'))}}"></script>
@stop
