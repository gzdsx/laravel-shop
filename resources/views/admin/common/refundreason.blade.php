@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>退款理由</h2>
    </div>
    <div class="content-div">
        <form method="post" autocomplete="off" id="listForm">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="50" class="center">删?</th>
                    <th width="60">排序</th>
                    <th>内容</th>
                </tr>
                </thead>
                <tbody id="express_list">
                @foreach($items as $item)
                <tr>
                    <td><input title="" type="checkbox" class="checkmark" name="delete[]" value="{{$item['id']}}"></td>
                    <td><input title="" type="text" class="form-control w60" name="items[{{$item['id']}}][displayorder]" value="{{$item['displayorder']}}"></td>
                    <td><input title="" type="text" class="form-control w500" name="items[{{$item['id']}}][title]" value="{{$item['title']}}"></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <label><input type="checkbox" data-action="checkall"> {{trans('common.selectall')}}</label>
                        <a id="addnew"><i class="iconfont icon-roundadd"></i>添加新项</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div class="btn-group-sm">
                            <input type="button" class="btn btn-primary" value="{{trans('common.submit')}}" id="submitButton">
                            <input type="button" class="btn btn-default" value="{{trans('common.refresh')}}" data-action="refresh">
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        var id = 0;
        $("#addnew").on('click', function () {
            $("#express_list").append('<tr>' +
                '                <td></td>' +
                '                <td><input type="text" class="form-control w60" name="items['+id+'][displayorder]"></td>\n' +
                '                <td><input type="text" class="form-control w500" name="items['+id+'][title]"></td>\n' +
                '            </tr>');
            id--;
        });
        $("#submitButton").on('click', function () {
            if ($(".checkmark:checked").length > 0) {
                DSXUI.showConfirm('删除确认', '你确认要删除所选项目吗?', function () {
                    $("#listForm").submit();
                });
            } else {
                $("#listForm").submit();
            }
        });
    </script>
@stop
