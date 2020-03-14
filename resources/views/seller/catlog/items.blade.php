@extends('layouts.seller')

@section('title', '商品管理')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{url('seller/catlog')}}">
                <span class="btn btn-danger">分类管理</span>
            </a>
        </div>
        <h2>分类"{{$catlog['name']}}"下的商品</h2>
    </div>

    <div class="content-div">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="dsxui-listtable">
            <thead>
            <tr>
                <th width="80">图片</th>
                <th>商品名称</th>
                <th>价格</th>
                <th>销量</th>
                <th>库存</th>
                <th>分类</th>
                <th>创建时间</th>
                <th>状态</th>
                <th width="80" class="align-center">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                <tr id="item_{{$item['itemid']}}">
                    <td>
                        <div class="bg-cover" style="width: 80px; height: 80px; background-image: url({{image_url($item['thumb'])}})"></div>
                    </td>
                    <td>
                        <h3><a href="{{item_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a></h3>
                        <p style="margin-top: 5px; color: #888; font-size: 12px;">{{$item['subtitle']}}</p>
                    </td>
                    <td>{{$item['price']}}</td>
                    <td>{{$item['sold']}}</td>
                    <td>{{$item['stock']}}</td>
                    <td>
                        @foreach ($item->cates as $cate)
                            <p>{{$cate['name']}}</p>
                        @endforeach
                    </td>
                    <td>{{@date('Y-m-d H:i', $item['created_at'])}}</td>
                    <td>
                        @if ($item['on_sale'])
                            出售中
                        @else
                            已下架
                        @endif
                    </td>
                    <td class="align-center">
                        <a href="javascript:;" rel="cancel" data-id="{{$item['itemid']}}">取消分类</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $(function () {
            $("a[rel=cancel]").on('click', function () {
                var itemid = $(this).attr('data-id');
                DSXUI.showConfirm('确认要取消分类吗', function () {
                    $.ajax({
                        url:'/seller/catlog/cancel',
                        type:'POST',
                        data:{itemid:itemid, catid:'{{$catid}}'},
                        success:function (response) {
                            $("#item_"+itemid).remove();
                        },
                        error:function (err) {
                            console.log(err);
                        }
                    });
                });
            });
        });
    </script>
@stop
