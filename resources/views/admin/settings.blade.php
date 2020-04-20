@extends('layouts.admin')

@section('title', '店铺设置')

@section('scripts')
    <script type="text/javascript">window.settings=@json($settings);</script>
@stop

@section('content')
@stop

@section('foot')
    <script src="{{asset('js/admin/settings/app.js?v='.time())}}" type="text/javascript"></script>
@stop
