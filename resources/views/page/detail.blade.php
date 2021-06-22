@extends('layouts.page')

@section('title', $page->title)

@section('content')
    <div class="page-detail">
        <div class="area">
            <div class="page-div">
                <div class="frame-left">
                    @foreach ($categories as $c)
                        <h3>{{$c->name}}</h3>
                        <ul>
                            @foreach($c->pages as $p)
                                <li><a href="{{$p->url}}" class="{{$p->id==$page->id ? 'active' :''}}">{{$p->title}}</a></li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>

                <div class="frame-main">
                    <div class="frame-content">
                        <h2 class="title">{{$page->title}}</h2>
                        <div class="content">{!! $page->content !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
