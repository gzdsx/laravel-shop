@extends('layouts.mobile')

@section('title', '搜索')

@section('content')
    <div style="position: relative; background-color: #fff; padding-bottom: 20px;">
        <div class="search-sidebar">
            <ul>
                @foreach ($catlogs as $catlog)
                    <li><a href="{{mobile_item_catlog_url($catlog['catid'])}}">{{$catlog['name']}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="search-main">
            @foreach ($catlogs as $catlog)
                <h3 class="title">{{$catlog['name']}}</h3>
                <ul class="catlogs">
                    @foreach ($catlog->childs as $child)
                        <li data-link="{{mobile_item_catlog_url($child['catid'])}}">
                            <div class="icon">
                                <img src="{{image_url($child['icon'])}}">
                            </div>
                            <div class="subtitle">{{$child['name']}}</div>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
    @include('mobile.tabbar', ['tab' => 'catlog'])
@stop
