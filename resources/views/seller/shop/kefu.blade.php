@extends('layouts.seller')

@section('title', '客服管理')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="javascript:;" id="addKefu">
                <span class="btn btn-danger">添加客服</span>
            </a>
        </div>
        <h2>客服管理</h2>
    </div>
    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            @csrf
            <input type="hidden" id="eventType" name="eventType" value="delete">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="30" class="first"><input title="" type="checkbox" class="checkmark" data-action="checkall"></th>
                    <th width="80">头像</th>
                    <th>昵称</th>
                    <th width="60" class="align-center">可用</th>
                    <th width="180" class="align-right">添加时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr id="row_{{$item['id']}}">
                        <td class="first"><input title="" type="checkbox" class="checkmark" name="items[]" value="{{$item['id']}}"></td>
                        <td>
                            <div class="bg-cover" style="width: 50px; height: 50px; background-image: url({{avatar($item['uid'])}})"></div>
                        </td>
                        <td><strong>{{$item['name']}}</strong></td>
                        <td class="align-center"><input title="" value="{{$item['id']}}" class="toggleAvailable" type="checkbox"@if($item['available']) checked="checked"@endif></td>
                        <td class="align-right">{{$item['created_at']}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="20">
                        <label><input type="checkbox" class="checkmark" data-action="checkall"> 全选</label>
                        <label><button type="submit" class="btn btn-sm btn-default btn-action" disabled="disabled">批量删除</button></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0 ) {
                    $(".btn-action").enable();
                } else {
                    $(".btn-action").disable();
                }
            });

            $("#addKefu").on('click', function () {
                var qrcode = '<div style="text-align:center;">' +
                    '<img src="{{url('seller/kefu/qrcode')}}" width="300" height="300" />' +
                '<div style="font-size:14px; padding:10px; text-align:center;">请客服人员用微信扫描二维码进行绑定</div></div>';
                DSXUI.dialog({
                    title:'添加客服',
                    showFooter:false,
                    content:qrcode,
                    style:{
                        width:'450px'
                    }
                });
            });

            $(".toggleAvailable").on('click', function () {
                var id = $(this).val();
                var available = $(this).is(":checked") ? 1 : 0;
                $.ajax({
                    url:'/seller/kefu/toggle',
                    data:{id:id, available:available}
                });
            });
        });
    </script>
@stop
