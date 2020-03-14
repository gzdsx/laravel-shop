@extends('layouts.user')

@section('title', '店铺收藏')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <form method="get">
                <div class="input-group">
                    <input type="text" name="q" value="{{$q}}" class="form-control w200" placeholder="店铺名称">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-primary" value="搜索">
                    </div>
                </div>
            </form>
        </div>
        <h2>我的收藏夹</h2>
    </div>

    <div class="dsxui-tabs-container">
        <ul class="dsxui-tabs">
            <li class="tab-item">
                <a href="{{url('user/collect/item')}}" class="tab-link">商品</a>
            </li>
            <li class="tab-item">
                <a href="{{url('user/collect/shop')}}" class="tab-link active">店铺</a>
            </li>
            <li class="tab-item">
                <a href="{{url('user/collect/post')}}" class="tab-link">文章</a>
            </li>
        </ul>
    </div>

    <div class="content-div">
        <table cellpadding="0" cellspacing="0" width="100%" border="0" class="dsxui-listtable">
            <thead>
            <tr>
                <th width="60">图片</th>
                <th>店铺名称</th>
                <th width="200">收藏时间</th>
                <th width="85" class="align-right">选项</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr id="collect-item-{{$item['id']}}">
                    <td>
                        <div class="pic">
                            <a href="{{shop_url($item['shop_id'])}}" target="_blank">
                                <img src="{{$item['shop']['logo']}}" width="50" height="50">
                            </a>
                        </div>
                    </td>
                    <td>
                        <h3 class="title"><a href="{{shop_url($item['shop_id'])}}" target="_blank">{{$item['shop']['shop_name']}}</a></h3>
                    </td>
                    <td>{{$item['created_at']}}</td>
                    <td class="align-right"><a href="javascript:;" rel="delete" data-id="{{$item['id']}}">取消收藏</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">{!! $pagination !!}</div>
@stop

@section('foot')
    <script type="text/javascript">
        $(function () {
            $("a[rel=delete]").on('click', function () {
                var id = $(this).attr('data-id');
                DSXUI.showConfirm('确定要取消收藏吗?', function () {
                    $.ajax({
                        type:'POST',
                        url:'{{url('user/collect/shop/delete')}}',
                        data:{id:id},
                        success: function(response){
                            $("#collect-item-"+id).remove();
                        }
                    });
                });
            });
        });
    </script>
@stop
