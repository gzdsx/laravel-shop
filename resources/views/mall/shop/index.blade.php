@extends('layouts.mall')

@section('title', '企业店铺')

@section('styles')
    <link href="{{asset('css/shop/index.css')}}" rel="stylesheet" type="text/css">
@stop

@section('content')
    <div class="area shop-filter">
        <ul class="tab">
            <li><a class="cur">默认</a></li>
            <li><a>销量</a></li>
            <li><a>信誉</a></li>
        </ul>
        <div class="search-hd">
            <form method="get">
                <div class="input-group">
                    <span class="input-group-prepend">店铺名称:</span>
                    <input title="" type="text" class="form-control w200" name="q" value="{{$q ?? ''}}">
                    <span class="input-group-append"><input type="submit" class="btn btn-primary" value="搜索"></span>
                </div>
            </form>
        </div>
    </div>
    <div class="area shop" style="min-height: 600px;">
        <div class="shop-grid-wrap">
            <ul>
                @foreach ($shops as $shop)
                    <li>
                        <div class="hd">
                            <div class="logo bg-cover" style="background-image: url({{$shop['logo']}})">
                                <a href="{{shop_url($shop['shop_id'])}}" target="_blank" title="{{$shop['shop_name']}}"></a>
                            </div>
                            <div class="shop-name">
                                <a href="{{shop_url($shop['shop_id'])}}" target="_blank">{{$shop['shop_name']}}</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="">{{$pagination}}</div>
    </div>
@stop
