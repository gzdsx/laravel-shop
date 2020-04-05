@extends('layouts.h5')

@section('title', '关于我们')

@section('content')
    <div class="aboutus">
        {!! $article->content !!}
    </div>
@stop
