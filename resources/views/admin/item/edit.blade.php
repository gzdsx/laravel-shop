@extends('layouts.admin')

@section('title', '编辑产品')

@section('styles')
    <link rel="stylesheet" href="{{asset('kindeditor/themes/default/default.css')}}" />
    <script src="{{asset('kindeditor/kindeditor-all-min.js')}}" type="text/javascript"></script>
@stop

@section('scripts')
    <script type="text/javascript">
        window.product = @json($item);
        window.catlogs = @json($catlogs);
        window.freightTemplates = @json($freightTemplates);
    </script>
@stop

@section('content')
@stop

@section('foot')
    <script src="{{asset('js/admin/item/app-edit.js?v='.time())}}" type="text/javascript"></script>
@stop
