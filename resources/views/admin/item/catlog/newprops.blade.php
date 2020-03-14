@extends('layouts.admin')

@section('title', '分类属性')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('item/catlog/props?catid='.$catid)}}">
                <span class="btn btn-primary">返回列表</span>
            </a>
        </div>
        <h2>分类管理->属性管理->@if($prop_id)编辑属性@else添加属性@endif</h2>
    </div>

    <div class="content-div">
        <form method="post" id="Form">
            @csrf
            <table class="dsxui-formtable" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td class="cell-label" width="60">名称:</td>
                    <td width="320" class="cell-input"><input title="" id="title" name="prop[title]" value="{{$prop['title']}}" class="form-control w300" type="text"></td>
                    <td>项目名称</td>
                </tr>
                <tr>
                    <td class="cell-label">必填:</td>
                    <td class="cell-content">
                        <label><input name="prop[required]" value="1" type="radio"@if ($prop['required']) checked="checked"@endif> 是</label>
                        <label><input name="prop[required]" value="0" type="radio"@if (!$prop['required']) checked="checked"@endif> 否</label>
                    </td>
                    <td>是否必填项</td>
                </tr>
                <tr>
                    <td class="cell-label">类型</td>
                    <td class="cell-input">
                        <select title="" class="form-control w300" name="prop[type]" id="type">
                            @foreach(trans('item.prop_types') as $k=>$v)
                                <option value="{{$k}}"@if($k===$prop['type']) selected="selected"@endif>{{$v}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>输入方式</td>
                </tr>
                <tr>
                    <td class="cell-label" width="60">默认值:</td>
                    <td width="320" class="cell-input"><input title="" name="prop[default]" value="{{$prop['default']}}" class="form-control w300" type="text"></td>
                    <td></td>
                </tr>
                </tbody>
                <tbody id="rules">
                <tr>
                    <td class="cell-label">选项列表</td>
                    <td>
                        <textarea title="" name="prop[options]" class="form-control w300" style="height: 100px;">{{$prop['options']}}</textarea>
                    </td>
                    <td>
                        <p>类型为单选，多选，选择时有效</p>
                        每行一个，如：<br>鼠标<br>键盘
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><input type="submit" class="btn btn-primary w100" value="保存"></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        (function () {
            $("#Form").on('submit', function () {
                var title = $.trim($("#title").val());
                if (!title) {
                    DSXUI.showToast('请填写属性名称');
                    return false;
                }
            });
        })();
    </script>
@stop
