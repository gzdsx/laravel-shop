@extends('layouts.app')

@section('title', $article['title'])

@section('styles')
    <style type="text/css">
        html, body {
            background-color: #fff;
        }

        * {
            color: #000;
            background-color: #fff;
        }

        p {
            text-align: justify;
        }

        article {
            display: block;
            text-align: justify;
            font-size: 18px;
            line-height: 1.5;
            color: #fff;
        }

        article * {
            max-width: 100%;
        }

        .container {
            display: block;
            overflow: hidden;
            padding: 20px;
        }

        .copyright{
            display: block;
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
    </style>
@stop

@section('content')

    <div class="container">
        <article>{!! $article['content'] !!}</article>
        <div class="copyright">&copy;2019 六盘水力爱迪科技有限公司版权所有</div>
    </div>
@stop
