@extends('layouts.mall')

@section('title', '商品分类')

@section('content')
    <div class="area">
        <div class="catlog">
            @foreach ($catlogs[0] as $catlog)
                <h3 class="group">{{$catlog['name']}}</h3>
                <ul class="items">
                    @if (isset($catlogs[$catlog['catid']]))
                        @foreach ($catlogs[$catlog['catid']] as $child)
                            <li>
                                <div class="ico">
                                    <a href="{{item_catlog_url($child['catid'])}}">
                                        <img src="{{image_url($child['icon'])}}">
                                    </a>
                                </div>
                                <div class="name">{{$child['name']}}</div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            @endforeach
        </div>
    </div>
    <script>$(".area,.nav").width(960);</script>
@stop
