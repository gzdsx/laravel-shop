@extends('layouts.seller')

@section('title', '发货信息')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{url('seller/sender/newsender')}}">
                <span class="btn btn-danger">添加发货信息</span>
            </a>
        </div>
        <h2>发货信息</h2>
    </div>
    <div class="content-div">
        <form>
            <table class="dsxui-listtable" cellspacing="0" cellpadding="0" width="100%">
                <thead>
                <tr>
                    <th width="200">发货人姓名</th>
                    <th width="200">电话</th>
                    <th>发货地址</th>
                    <th width="80">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr id="sender_{{$item->id}}">
                        <td>{{$item->name}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->province.$item->city.$item->district.$item->street}}</td>
                        <td>
                            <a href="{{url('seller/sender/newsender?id='.$item->id)}}">编辑</a>
                            <a rel="delete" data-id="{{$item->id}}">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $(function () {
            $("[rel=delete]").on('click', function () {
                var id = $(this).attr('data-id');
                DSXUI.showConfirm('确认要删除所选信息吗?', function () {
                    $.ajax({
                        url:'{{url('seller/sender/delete')}}',
                        data:{id:id},
                        success:function () {
                            $("#sender_"+id).remove();
                        }
                    });
                });
            });
        });
    </script>
@stop
