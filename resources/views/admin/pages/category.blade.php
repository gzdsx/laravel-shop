@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('pages')}}" role="button">
                <span class="btn btn-primary">页面管理</span>
            </a>
        </div>
        <h2>页面分类</h2>
    </div>
    <div class="content-div">
        <form method="post" id="listForm">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="40">删?</th>
                    <th width="80">显示顺序</th>
                    <th>分类名称</th>
                </tr>
                </thead>
                <tbody id="newCategory">
                @foreach($categories as $catgory)
                <tr>
                    <td><input type="checkbox" title="" class="checkmark" name="delete[]" value="{{$catgory['pageid']}}" /></td>
                    <td><input type="number" title="" class="form-control w60" name="categories[{{$catgory['pageid']}}][displayorder]" value="{{$catgory['displayorder']}}" maxlength="4"></td>
                    <td><input type="text" title="" class="form-control w200" name="categories[{{$catgory['pageid']}}][title]" value="{{$catgory['title']}}" maxlength="10"> </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <label><input type="checkbox" name="delete[]" data-action="checkall" /> 全选</label>
                        <a href="javascript:;" onclick="addClass()"><i class="iconfont icon-roundadd"></i>添加分类</a></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="btn-group-sm">
                            <input type="button" class="btn btn-primary" value="提交" id="submitButton" />
                            <input type="button" class="btn btn-default" value="刷新" data-action="refresh" />
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/template" id="J-category-tpl">
        <tr>
            <td></td>
            <td><input type="text" title="" class="form-control w60" name="categories[#k#][displayorder]" value="0" maxlength="4"></td>
            <td><input type="text" title="" class="form-control w200" name="categories[#k#][title]" value="" maxlength="10"></td>
        </tr>
    </script>
    <script type="text/javascript">
        var k = 0;
        function addClass(){
            k--;
            var html = $("#J-category-tpl").html().replace(/#k#/g, k);
            $("#newCategory").append(html);
        }

        $("#submitButton").on('click', function () {
            if ($(".checkmark:checked").length > 0) {
                DSXUI.showConfirm('你确认要删除所选页面吗?', function () {
                    $("#listForm").submit();
                });
            } else {
                $("#listForm").submit();
            }
        });
    </script>
@stop
