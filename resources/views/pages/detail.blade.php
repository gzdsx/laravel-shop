@extends('layouts.mall')

@section('title', $pageData['title'])

@section('content')
    <div class="area">
        <div class="page-detail">
            <div class="sidebar">
                @foreach ($categoryList as $category)
                    <h3>{{$category['title']}}</h3>
                    <ul>
                        @if (isset($pageList[$category['pageid']]))
                            @foreach($pageList[$category['pageid']] as $page)
                                <li><a href="{{page_url($page['pageid'])}}">{{$page['title']}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                @endforeach
            </div>

            <div class="main-frame">
                <div class="frame-content">
                    <h2 class="title">{{$pageData['title']}}</h2>
                    <div class="content">{!! $pageData['content'] !!}</div>
                </div>
            </div>
        </div>
    </div>
    <script>$(".area,.nav").width(960);</script>
@stop
