@extends('layouts.h5')

@section('content')
    <transition appear>
        <router-view></router-view>
    </transition>
@stop

@section('foot')
    <script src="{{asset('js/h5/base.js')}}"></script>
    <script src="{{asset('js/h5/index.js')}}"></script>
@stop
