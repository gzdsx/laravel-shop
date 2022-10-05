@extends('layouts.error')

@section('title', $exception->getMessage())

@section('content')
    <div class="error-icon">
        <img src="{{asset('images/common/failed.png')}}">
    </div>
    <h2 style="color: #d81e06;">{{$exception->getMessage()}}</h2>
    <div class="links">
        @foreach ($exception->links as $link)
            <a href="{{$link[1]}}">{{$link[0]}}</a>
        @endforeach
    </div>
@stop
