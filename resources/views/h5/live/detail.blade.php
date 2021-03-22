@extends('layouts.h5')

@section('title', '直播')

@section('foot')
    <script type="text/javascript">
        var pageConfig = {
            id: '{{$id}}',
            uid: '{{auth()->id()}}',
            username: '{{auth()->user() ? auth()->user()->username : ''}}',
            avatar: '{{auth()->user() ? auth()->user()->avatar : ''}}',
        }
    </script>
    <script src="{{asset('js/lib/DPlayer.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/hls.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('static/h5/live/detail.js?v='.config('app.version'))}}" type="text/javascript"></script>
@stop
