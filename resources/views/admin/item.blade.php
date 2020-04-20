@extends('layouts.admin')

@section('title', '商品管理')

@section('styles')
    <link href="{{asset('kindeditor/themes/default/default.css')}}" rel="stylesheet"/>
    <script src="{{asset('kindeditor/kindeditor-all-min.js')}}" type="text/javascript"></script>
@stop

@section('scripts')
    <script type="text/javascript">
        window.catlogs = @json($catlogs);
        window.freightTemplates = @json($freightTemplates);
    </script>
@stop

@section('content')
@stop

@section('foot')
    <script src="{{asset('js/admin/item/app.js?v='.time())}}" type="text/javascript"></script>
@stop
