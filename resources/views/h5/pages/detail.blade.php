@extends('layouts.h5')

@section('title', $page['title'])

@section('content')
    <div class="pages-detail">
        <article class="content">
            {!! $page['content'] !!}
        </article>
    </div>
@stop
