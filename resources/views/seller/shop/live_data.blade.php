<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', '')</title>
    <link href="{{asset('css/seller.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/common.js')}}" type="text/javascript"></script>
    <style type="text/css">
        body,html{
            margin: 0;
            padding: 0;
            display: block;
        }
        .shopDataContainer{display: block; padding: 0; margin: 0; height: 240px;}
        .shopDataContainer .title{
            height: 45px;
            line-height: 45px;
            font-size: 14px;
            padding-left: 16px;
            border-bottom: 1px #e0e0e0 solid;
        }
        .shopDataContainer .content{display: block; margin: 0; overflow: hidden;}
        .shopDataContainer .index-cell{width: 33.33%; float: left; margin: -1px 0 0 -1px; height: 97px; border-top: 1px #e0e0e0 solid; border-left: 1px #e0e0e0 solid;}
        .shopDataContainer .live-wrapper{display: block; padding: 15px;}
        .shopDataContainer .live-wrapper .iconfont{
            font-size: 30px; width: 45px; height: 45px; line-height: 45px; color: #fff;
            border-radius: 50%; float: left; padding: 0; text-align: center;
        }
        .shopDataContainer .live-wrapper .live-detail{height: 45px; margin-left: 60px;}
        .shopDataContainer .live-wrapper .live-detail p{font-size: 14px; display: block; margin-bottom: 5px; overflow: hidden; padding-top: 5px; line-height: 1;}
        .shopDataContainer .live-wrapper .live-detail div{font-size: 14px;}
    </style>
</head>
<body>
<div class="shopDataContainer">
    <div class="title">实时数据</div>
    <div class="content">
        <div class="index-cell">
            <div class="live-wrapper">
                <div class="iconfont" style="background-color: #1E9CFF;">&#xe6ed;</div>
                <div class="live-detail">
                    <p>支付金额</p>
                    <div>0</div>
                </div>
            </div>
        </div>
        <div class="index-cell">
            <div class="live-wrapper">
                <div class="iconfont" style="background-color: #00C69F;">&#xe69d;</div>
                <div class="live-detail">
                    <p>访客</p>
                    <div>0</div>
                </div>
            </div>
        </div>
        <div class="index-cell">
            <div class="live-wrapper">
                <div class="iconfont" style="background-color: #FFBD00;">&#xe772;</div>
                <div class="live-detail">
                    <p>支付买家</p>
                    <div>{{$payerCount}}</div>
                </div>
            </div>
        </div>
        <div class="index-cell">
            <div class="live-wrapper">
                <div class="iconfont" style="background-color: #FF8426;">&#xe81a;</div>
                <div class="live-detail">
                    <p>浏览量</p>
                    <div>{{$shop['views']}}</div>
                </div>
            </div>
        </div>
        <div class="index-cell">
            <div class="live-wrapper">
                <div class="iconfont" style="background-color: #FF618E;">&#xe75a;</div>
                <div class="live-detail">
                    <p>订单数</p>
                    <div>{{$orderCount}}</div>
                </div>
            </div>
        </div>
        <div class="index-cell">
            <div class="live-wrapper">
                <div class="iconfont" style="background-color:#f40;">&#xe6d3;</div>
                <div class="live-detail">
                    <p>在售商品</p>
                    <div>{{$itemCount}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
