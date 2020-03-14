@extends('layouts.mall')

@section('title', '粗耕优选')

@section('styles')
    <link href="{{asset('css/item/youxuan.css')}}" rel="stylesheet" type="text/css">
@stop

@section('content')
    <div class="yourpos">
        <div class="area">
            <a href="{{url('/')}}">粗耕首页</a>
            <span> > </span>
            <span>粗耕优选</span>
        </div>
    </div>
    <div class="area youxuan" style="margin-top: 20px;">
        <div class="item-list-wrap">
            <ul class="item-list">
                @foreach ($itemlist as $item)
                    <li>
                        <div class="bd">
                            <div class="g-pic bg-cover asyncload" data-original="{{image_url($item['thumb'])}}">
                                <a href="{{item_url($item['itemid'])}}" title="{{$item['title']}}" target="_blank"></a>
                            </div>
                            <div class="g-name">
                                <a href="{{item_url($item['itemid'])}}" title="{{$item['title']}}" target="_blank">{{$item['title']}}</a>
                            </div>
                            <div class="line">
                                <span class="sold">已售{{$item['sold']}}件</span>
                                <div class="price"><span>￥</span><strong>{{$item['price']}}</strong></div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="blank"></div>
            <div class="pagination">{{$pagination}}</div>
        </div>
    </div>
@stop
