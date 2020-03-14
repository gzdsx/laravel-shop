@extends('layouts.seller')

@section('title', '运费模板')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{seller_url('freight/newtemplate')}}">
                <span class="btn btn-danger">添加运费模板</span>
            </a>
        </div>
        <h2>运费模板</h2>
    </div>
    <div class="content-div">
        <form>
            <table class="dsxui-listtable" cellspacing="0" cellpadding="0" width="100%">
                <thead>
                <tr>
                    <th width="200">模板名称</th>
                    <th>说明</th>
                    <th width="80">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr id="template_{{$item->template_id}}">
                        <td>{{$item->template_name}}</td>
                        <td>
                            <p>{{$item->start_quantity}}件内{{$item->start_fee}}元;每增加{{$item->growth_quantity}}件{{$item->growth_fee}}元</p>
                            <p>{{$item->free_quantity}}件以上包邮或者金额满{{$item->free_amount}}包邮</p>
                        </td>
                        <td>
                            <a href="{{seller_url('freight/newtemplate?template_id='.$item->template_id)}}">编辑</a>
                            <a rel="delete" data-id="{{$item->template_id}}">删除</a>
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
                var template_id = $(this).attr('data-id');
                DSXUI.showConfirm('确认要删除所选模板吗?', function () {
                    $.ajax({
                        type:'POST',
                        url:'{{seller_url('freight/delete')}}',
                        data:{template_id:template_id},
                        success:function () {
                            $("#template_"+template_id).remove();
                        }
                    });
                });
            });
        });
    </script>
@stop
