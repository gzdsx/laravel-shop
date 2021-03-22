@extends('layouts.h5')

@section('title', $page->title)

@section('content')
    <div class="pages">
        <div class="page-content">{!! $page->content !!}</div>
    </div>
@stop
