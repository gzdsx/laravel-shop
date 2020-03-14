@extends('layouts.h5')

@section('title', $news['title'])

@section('styles')
    <style type="text/css">
        .news{
            display: block;
            background-color: #fff;
            padding: 15px 10px;
            color: #333;
        }

        .news *{
            max-width: 100%;
        }

        .news .title{
            font-size: 18px;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .news .info{
            display: block;
            border-bottom: 1px #e5e5e5 solid;
            margin-bottom: 10px;
            font-size: 14px;
            color: #666;
            line-height: 2;
        }

        .news .info .display-flex{
            display: flex;
        }

        .news .info .flex{
            flex: 1;
        }
        .news .images{
            display: block;
        }

        .news .images img{
            width: 100%;
            max-width: 100%;
            height: auto;
            display: block;
        }

        .news .content{
            display: block;
            padding: 10px 0;
            font-size: 16px;
            line-height: 1.5;
            text-align: justify;
        }

        .news .content *{
            max-width: 100%;
        }

        .news .pubtime{
            font-size: 14px;
            color: #666;
        }
    </style>
@stop

@section('content')
<div class="news">
    <h1 class="title">{{$news['title']}}</h1>
    <div class="info">
        <div class="display-flex">
            <div class="flex">价格:{{$news->price}}</div>
            <div>产量:{{$news->quantity}}{{$news->unit}}</div>
        </div>
        <div class="display-flex">
            <div class="flex">联系电话:{{$news->phone}}</div>
        </div>
        <div>地点:{{$news->province.$news->city.$news->district.$news->street}}</div>
    </div>
    <div class="images">
        @foreach ($images as $image)
            <img src="{{$image->image}}">
        @endforeach
    </div>
    <div class="content">{{$news->description}}</div>
    <div class="pubtime">发布时间:{{$news->created_at}}</div>
</div>
@stop
