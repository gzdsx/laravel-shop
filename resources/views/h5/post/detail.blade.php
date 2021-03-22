@extends('layouts.h5')

@section('title', '正文')

@section('content')
<div class="app" style="background-color: #fff;">
    <article class="weui-article">
        <h1 class="text-center">{{$post['title']}}</h1>
        <div style="text-align: center; color: #777; font-size: 14px; display: block; margin-bottom: 20px;">
            <span style="margin-right: 10px;">时间:{{$post['created_at']}}</span>
            <span>阅读:{{$post['views']}}</span>
        </div>
        <section>
            {!! $post->content['content'] !!}
        </section>
    </article>
</div>
@stop
