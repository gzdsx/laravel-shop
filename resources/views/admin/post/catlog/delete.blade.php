@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('post/catlog')}}">
                <span class="btn btn-primary">返回列表</span>
            </a>
        </div>
        <h2>文章管理 -> 分类管理 -> 删除分类</h2>
    </div>
    <div class="content-div">
        <form method="post" id="Form" autocomplete="off">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                <tbody>
                <tr>
                    <td width="80">删除分类</td>
                    <td width="320">{{$catlog['name']}}</td>
                    <td class="tips"></td>
                </tr>
                <tr>
                    <td>删除子分类及数据</td>
                    <td>
                        <label><input type="radio" name="deleteChilds" value="1"> 是 </label>
                        <label><input type="radio" name="deleteChilds" value="0" checked="checked"> 否</label>
                    </td>
                    <td class="tips">选择是否删除子分类</td>
                </tr>
                <tr>
                    <td>移入分类</td>
                    <td>
                        <select name="moveto" id="moveto" class="form-control w300" title="" size="10" style="height: 200px;">
                            @foreach ($catlogs as $super)
                                <option value="{{$super['catid']}}"@if($catlog->catid==$super['catid']) disabled="disabled"@endif>{{$super['name']}}</option>
                                @foreach ($super['childs'] as $child)
                                    <option value="{{$child['catid']}}"@if($catlog->catid==$child['catid']) disabled="disabled"@endif>|--{{$child['name']}}</option>
                                    @foreach ($child['childs'] as $sub)
                                        <option value="{{$sub['catid']}}"@if($catlog->catid==$sub['catid']) disabled="disabled"@endif>|--|--{{$sub['name']}}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </td>
                    <td class="tips">删除分类同时将分类下的数据移动到此分类</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="5"><label><input type="submit" class="btn btn-primary" value="确认删除"></label></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $("#Form").on('submit', function () {
            if ($("[name=deleteChilds]:checked").val() === '0'){
                if (!$("#moveto").val()){
                    DSXUI.error('请选择移入目标分类');
                    return false;
                }

                if ($("#moveto").val() === '{{$catlog->catid}}'){
                    DSXUI.error('目标分类不能喝源分类相同');
                    return false;
                }
            }
        });
    </script>
@stop
