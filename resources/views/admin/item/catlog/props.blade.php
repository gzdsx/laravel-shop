@extends('layouts.admin')

@section('title', '分类属性')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('item/catlog/newprops?catid='.$catid)}}">
                <span class="btn btn-primary">添加属性</span>
            </a>
            <a href="javascript:;" id="extendsProps">
                <span class="btn btn-primary">从上级继承</span>
            </a>
        </div>
        <h2>分类管理->属性管理</h2>
    </div>
    <div class="content-div">
        <form method="post" id="listForm">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="40">删?</th>
                    <th>名称</th>
                    <th width="160">默认值</th>
                    <th width="80">类型</th>
                    <th width="80">必填项</th>
                    <th width="60">选项</th>
                </tr>
                </thead>
                <tbody id="typelist">
                @foreach($properties as $prop)
                    <tr>
                        <td><input type="checkbox" title="" class="checkmark" name="delete[]" value="{{$prop['prop_id']}}" /></td>
                        <td>{{$prop['title']}}</td>
                        <td>{{$prop['default']}}</td>
                        <td>{{$prop_types[$prop['type']]}}</td>
                        <td><input title="" type="checkbox" value="1" @if($prop['required']) checked="checked"@endif></td>
                        <td class="actions">
                            <a href="{{admin_url('item/catlog/newprops?catid='.$catid.'&prop_id='.$prop['prop_id'])}}">编辑</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10" class="btn-group-sm">
                        <label class="form-check-label"><input type="checkbox" class="checkbox" data-action="checkall" /> 全选</label>
                        <input type="submit" class="btn btn-sm btn-default" value="删除" disabled="disabled" id="submitButton" />
                        <input type="button" class="btn btn-sm btn-default" value="刷新" data-action="refresh" />
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        (function () {
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0) {
                    $("#submitButton").enable();
                } else {
                    $("#submitButton").disable();
                }
            });
            $("#extendsProps").on('click', function () {
                DSXUI.showConfirm('提示', '确认要从上级分类继承分类属性吗？', function () {
                    $.ajax({
                        url:'{{admin_url('item/catlog/extendprops')}}',
                        data:{catid:'{{$catid}}'},
                        success:function () {
                            DSXUtil.reFresh();
                        }
                    });
                });
            });
        })();
    </script>
@stop
