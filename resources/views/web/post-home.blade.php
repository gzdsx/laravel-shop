@extends('layouts.default')

@section('body_class','post-home')
@section('title','资讯')

@section('content')
    <div class="container">
        <div class="swiper-container">
            <div class="swiper" id="swiper">
                <ul class="swiper-wrapper">
                    @foreach (get_block_items(1) as $slide)
                        <li class="swiper-slide">
                            <a href="{{$slide->url}}">
                                <div class="slide-image">
                                    <img src="{{$slide->image}}" class="swiper-slide-image" alt="">
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        (function () {
            new Swiper('#swiper', {
                loop: true,
                autoplay: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                }
            });
        })();
    </script>
    <div class="blank-1"></div>
    <div class="container">
        <div class="row flex-column flex-lg-row">
            <div class="col col-lg-9">
                <div class="page-section">
                    <ul class="nav-categories">
                        <li><a href="{{url('post')}}" class="{{$category->name ? '' : 'active'}}">推荐</a></li>
                        @foreach (get_categories(['taxonomy'=>'post','parent'=>0]) as $cate)
                            <li>
                                <a href="{{url('post',['cate'=>$cate])}}"
                                   class="{{$cate->cate_id==$category->cate_id ? 'active' : ''}}">{{$cate->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="post-list">
                        @foreach ($items as $item)
                            <div class="post-list-item">
                                @if ($item->image)
                                    <div class="thumb">
                                        <a href="{{$item->url}}" target="_blank">
                                            <img src="{{$item->image}}" alt="{{$item->title}}">
                                        </a>
                                    </div>
                                @endif
                                <div class="flex-fill overflow-hidden position-relative">
                                    <div class="title"><a href="{{$item->url}}" target="_blank">{{$item->title}}</a>
                                    </div>
                                    <p>{!! $item->excerpt !!}</p>
                                    <div class="bot">
                                        <span>{{$item->from}} · {{$item->views}}浏览 · {{$item->created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="nav-pagination">
                        {{$items->render()}}
                    </div>
                </div>
            </div>
            <div class="col col-lg-3">
                <div class="post-tougao">
                    <a>
                        <span class="iconfont icon-daohang font-22"></span>
                        <span>投稿</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop