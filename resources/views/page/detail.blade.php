@extends('layouts.page')

@section('title', $page->title)

@section('content')
    <div class="page-detail">
        <div class="area">
            <div class="page-div">
                <div class="frame-left">
                    @foreach ($categories as $p)
                        <h3>{{$p->title}}</h3>
                        <ul>
                            @foreach($p->pages as $pp)
                                <li><a href="{{$pp->url}}" class="{{$pp->pageid==$page->pageid ? 'active' :''}}">{{$pp->title}}</a></li>
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
