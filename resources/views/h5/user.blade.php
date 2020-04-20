@extends('layouts.h5')

@section('title', '个人中心')

@section('scripts')
    <script type="text/javascript">window.userData=@json($user);</script>
@stop

@section('foot')
    <script src="{{asset('js/h5/user.js?v='.time())}}" type="text/javascript"></script>
@stop
