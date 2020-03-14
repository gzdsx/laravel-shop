@extends('layouts.seller')

@section('title', '卖家中心')

@section('content')
    <div class="header-info">
        <div class="row">
            <div class="col-md-3">
                <a>
                    <div class="info-num">0</div>
                    <div class="info-text">待发货订单</div>
                </a>
            </div>
            <div class="col-md-3">
                <a>
                    <div class="info-num">0</div>
                    <div class="info-text">退款售后订单</div>
                </a>
            </div>
            <div class="col-md-3">
                <a>
                    <div class="info-num">0</div>
                    <div class="info-text">待查看消息</div>
                </a>
            </div>
            <div class="col-md-3">
                <a>
                    <div class="info-num">{{$wallet['balance']}}</div>
                    <div class="info-text">账户余额</div>
                </a>
            </div>
        </div>
    </div>

    <div class="quick-entry">
        <div class="entry-title">快捷入口</div>
        <div class="entry-module-div row">
            <div class="entry-module col-md-3">
                <div class="module">
                    <a href="{{url('seller/item/publish')}}">
                        <span class="iconfont icon-goodsnewfill"></span>
                        <span class="module-title">发布商品</span>
                    </a>
                </div>
            </div>
            <div class="entry-module col-md-3">
                <div class="module">
                    <a href="{{url('seller/sold')}}">
                        <span class="iconfont icon-form_fill_light"></span>
                        <span class="module-title">订单管理</span>
                    </a>
                </div>
            </div>
            <div class="entry-module col-md-3">
                <div class="module">
                    <a>
                        <span class="iconfont icon-peoplefill"></span>
                        <span class="module-title">客户管理</span>
                    </a>
                </div>
            </div>
            <div class="entry-module col-md-3">
                <div class="module">
                    <a>
                        <span class="iconfont icon-rechargefill"></span>
                        <span class="module-title">提现记录</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="index-foot row">
        <div class="col-md-8">
            <div class="entry-title">公告</div>
            <div class="notice-content">
                <ul>
                    @foreach ($notices as $notice)
                        <li>
                            <span>{{$notice->created_at->format('Y/m/d H:i')}}</span>
                            <p><a href="{{post_detail_url($notice['aid'])}}" target="_blank">{{$notice['title']}}</a></p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="entry-title">学习与交流</div>
            <div class="learn-content">
                <div class="learn-item">
                    <a>
                        <span class="iconfont icon-read"></span>
                        <div class="learn-text">
                            <div class="title">新手入门</div>
                            <p class="text">五分钟教你快速开店</p>
                        </div>
                    </a>
                </div>
                <div class="blank"></div>
                <div class="learn-item">
                    <a>
                        <span class="iconfont icon-brand"></span>
                        <div class="learn-text">
                            <div class="title">引流推广</div>
                            <p class="text">提升品牌知名度</p>
                        </div>
                    </a>
                </div>
                <div class="blank"></div>
                <div class="learn-item">
                    <a>
                        <span class="iconfont icon-group"></span>
                        <div class="learn-text">
                            <div class="title">客户管理</div>
                            <p class="text">提高买家复购率</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
