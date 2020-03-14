@extends('layouts.h5')

@section('title', '附近的店')

@section('content')
    <div class="shop-list">
        @foreach ($shops as $shop)
            <div class="shop-item">
                <div class="info">
                    <div class="logo bg-cover" style="background-image: url({{$shop['logo']}})"></div>
                    <div class="name">{{$shop['shop_name']}}</div>
                    <div class="action">
                        <div class="button" data-link="{{h5_shop_url($shop['shop_id'])}}">进店</div>
                    </div>
                </div>
                <div class="items">
                    @foreach($shop['items'] as $item)
                        <div class="item" data-link="{{h5_item_url($item['itemid'])}}">
                            <div class="bg bg-cover" style="background-image: url({{$item['thumb']}})"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@stop
