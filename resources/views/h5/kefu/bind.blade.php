@extends('layouts.h5')

@section('title', '绑定客服')

@section('content')
    <style type="text/css">
        .kefu{
            display: block;
            padding: 30px 20px;
            background-color: #fff;
        }

        .kefu .logo{
            text-align: center;
            display: block;
        }

        .kefu .logo .image{
            width: 80px;
            height: 80px;
            border-radius: 10px;
            display: inline-block;
        }

        .kefu .shop-name{
            font-size: 18px;
            text-align: center;
            display: block;
            margin: 10px 0;
        }

        .kefu .tips{
            text-align: center;
            font-size: 16px;
            color: #666;
            display: block;
            margin-bottom: 50px;
        }

        .kefu .button{
            padding: 12px 0;
            display: block;
            background-color: #2FC361;
            color: #fff;
            text-align: center;
            font-size: 16px;
            border-radius: 10px;
        }
    </style>
<div class="kefu">
    <div class="logo">
        <div class="image bg-cover" style="background-image: url({{image_url($shop['logo'])}})"></div>
    </div>
    <div class="shop-name">{{$shop['shop_name']}}</div>

    @if ($kefu)
        <div class="tips">你已成为该店客服人员</div>
    @else
        <div class="tips">点击确认按钮成为该店铺的客服人员</div>

        <div class="button" id="bind">确认</div>
    @endif

</div>
    <script type="text/javascript">
        $("#bind").on('click', function () {
            $.ajax({
                url:'/h5/kefu/binduser',
                data:{shop_id:'{{$shop_id}}'},
                success:function (response) {
                    if (response.errcode){
                        DSXUI.showToast(response.errmsg);
                    } else {
                        DSXUtil.reFresh();
                    }
                }
            });
        });
    </script>
@stop
