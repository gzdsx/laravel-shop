@extends('layouts.h5')

@section('title', $page->title)

@section('content')
    <div class="news-detail">
        <div class="body">
            <div class="content">{!! $page->content !!}</div>
        </div>
    </div>
@stop
