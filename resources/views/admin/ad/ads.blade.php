@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('ad/newad')}}">
                <span class="btn btn-primary">添加广告</span>
            </a>
        </div>
        <h2>广告管理</h2>
    </div>
    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            @csrf
            <input type="hidden" name="eventType" value="" id="J_eventType">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="40"><input type="checkbox" class="checkmark" data-action="checkall"></th>
                    <th width="60">ID</th>
                    <th>广告名称</th>
                    <th width="100">类型</th>
                    <th width="100">开始时间</th>
                    <th width="100">结束时间</th>
                    <th width="80" class="align-center">点击数</th>
                    <th width="80">状态</th>
                    <th width="50">编辑</th>
                </tr>
                </thead>
                <tbody id="mainbody">
                @foreach($items as $item)
                    <tr>
                        <td><input title="" type="checkbox" class="checkbox checkmark" name="items[]"
                                   value="{{$item->id}}"></td>
                        <td>{{$item->id}}</td>
                        <td>{{$item['title']}}</td>
                        <td>{{$item['type_desc']}}</td>
                        <td>{{$item['begin_at']}}</td>
                        <td>{{$item['end_at']}}</td>
                        <td class="align-center">{{$item['clicks']}}</td>
                        <td>{{$item['available'] ? '可用' : '已停用'}}</td>
                        <td><a href="{{admin_url('ad/newad?id='.$item->id)}}">编辑</a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="float-right">{!! $pagination !!}</div>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" class="checkmark" data-action="checkall"> 全选</label>
                            <button type="button" class="btn btn-default btn-action" id="delete" disabled="disabled">
                                删除
                            </button>
                            <button type="button" class="btn btn-default btn-action" id="enable" disabled="disabled">
                                启用
                            </button>
                            <button type="button" class="btn btn-default btn-action" id="disable" disabled="disabled">
                                停用
                            </button>
                            <button type="button" class="btn btn-default" data-action="refresh">刷新</button>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            function submitForm(url) {
                $("#listForm").ajaxSubmit({
                    url: url,
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
            }

            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0) {
                    $(".btn-action").enable();
                } else {
                    $(".btn-action").disable();
                }
            });

            $("#delete").on('click', function () {
                DSXUI.showConfirm('删除确认', '确认要删除所选项目吗?', function () {
                    submitForm('{{admin_url('ad/delete')}}');
                });
            });

            $("#enable").on('click', function () {
                submitForm('{{admin_url('ad/enable')}}');
            });

            $("#disable").on('click', function () {
                submitForm('{{admin_url('ad/disable')}}');
            });
        });
    </script>
@stop
