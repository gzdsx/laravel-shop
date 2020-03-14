@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <a href="javascript:;" class="float-right" id="add_block">
            <span class="btn btn-primary">添加板块</span>
        </a>
        <h2>内容模块->模块管理</h2>
    </div>
    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="50"><label><input type="checkbox" class="checkmark" data-action="checkall"></label></th>
                    <th width="60">ID</th>
                    <th width="300">名称</th>
                    <th>说明</th>
                    <th width="80">编辑</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><input title="" type="checkbox" class="checkmark itemCheckBox" name="items[]"
                                   value="{{$item['block_id']}}"></td>
                        <td>{{$item['block_id']}}</td>
                        <td><a rel="edit" data-id="{{$item['block_id']}}">{{$item['block_name']}}</a></td>
                        <td>{{$item['block_desc']}}</td>
                        <td><a href="{{admin_url('block/items?block_id='.$item['block_id'])}}">内容管理</a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="float-right">{!! $pagination !!}</div>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" class="checkmark" data-action="checkall"> 全选</label>
                            <button type="button" class="btn btn-default" id="delete" disabled="disabled">批量删除</button>
                            <button type="button" class="btn btn-default" data-action="refresh">刷新</button>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/template" id="blockFormTpl">
        <div style="padding: 10px 20px;">
            <form method="post" id="J_Frmblock" action="{{admin_url('block/save')}}">
                @csrf
                <input type="hidden" name="block_id" value="{block.block_id}">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                    <tbody>
                    <tr>
                        <td class="cell-name">板块名称</td>
                        <td><input title="" type="text" class="form-control w300" name="block[block_name]"
                                   value="{block.block_name}" id="J_block_name"></td>
                    </tr>
                    <tr>
                        <td class="cell-name">板块说明</td>
                        <td><textarea title="" class="form-control w300" name="block[block_desc]" id="J_block_desc"
                                      style="height: 100px;">{block.block_desc}</textarea></td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </script>

@stop

@section('foot')
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0) {
                    $("#delete").enable();
                } else {
                    $("#delete").disable();
                }
            });
            $("#add_block").on('click', function (e) {
                var html = $("#blockFormTpl").html().replace(/\{block\.(.*?)\}/g, function () {
                    return '';
                });
                DSXUI.dialog({
                    title: '添加板块',
                    content: html,
                    onConfirm: function (dlg) {
                        var block_name = $.trim($("#J_block_name").val());
                        if (!block_name) {
                            DSXUI.showToast('请填写板块名称');
                            return false;
                        }
                        $("#J_Frmblock").ajaxSubmit({
                            dataType: 'json',
                            success: function (response) {
                                if (!response.errcode) {
                                    dlg.close();
                                    window.location.href = "{{admin_url('block')}}?sp=" + Math.random();
                                }
                            }
                        });
                    }
                });
            });

            $("a[rel=edit]").on('click', function () {
                var block_id = $(this).attr('data-id');
                $.ajax({
                    url: "{{admin_url('block/get')}}",
                    data: {block_id: block_id},
                    dataType: 'json',
                    success: function (responsedata) {
                        var html = $("#blockFormTpl").html().replace(/\{block\.(.*?)\}/g, function (s, k) {
                            return responsedata.block[k];
                        });
                        DSXUI.dialog({
                            title: '编辑板块',
                            content: html,
                            onConfirm: function (dlg) {
                                var block_name = $.trim($("#J_block_name").val());
                                if (!block_name) {
                                    DSXUI.showToast('请填写板块名称');
                                    return false;
                                }
                                $("#J_Frmblock").ajaxSubmit({
                                    dataType: 'json',
                                    success: function (response) {
                                        if (!response.errcode) {
                                            dlg.close();
                                            window.location.href = "{{admin_url('block')}}?sp=" + Math.random();
                                        }
                                    }
                                });
                            }
                        });
                    }
                });
            });

            $("#delete").on('click', function () {
                DSXUI.showConfirm('确认删除所选板块吗?', function () {
                    $("#listForm").ajaxSubmit({
                        dataType: 'json',
                        beforeSend: function () {
                            DSXUI.showSpinner();
                        }, success: function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                if (response.errcode) {
                                    DSXUI.error(response.errmsg);
                                } else {
                                    DSXUtil.reFresh();
                                }
                            }, 500);
                        }
                    });
                });
            });
        });
    </script>
@stop
