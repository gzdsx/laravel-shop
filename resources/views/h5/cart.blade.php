@extends('layouts.h5')

@section('title', '购物车')

@section('content')
@stop

@section('foot')
    <script src="{{asset('js/h5/cart.js?v='.time())}}"></script>
@stop
