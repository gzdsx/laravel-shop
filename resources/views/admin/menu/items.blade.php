@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <a href="{{admin_url('menu')}}" class="float-right">
            <span class="btn btn-primary">返回菜单列表</span>
        </a>
        <h2>菜单管理->{{$menu['name']}}</h2>
    </div>
    <div class="table-wrap">
        <form method="post" id="menuForm">
            {{csrf_field()}}
            <table cellpadding="0" cellspacing="0" width="100%" class="dsxui-listtable border-none">
                <thead>
                <tr>
                    <th width="40">删?</th>
                    <th width="70">图标</th>
                    <th width="120">名称</th>
                    <th>链接</th>
                    <th width="80">打开方式</th>
                    <th width="40">可用</th>
                </tr>
                </thead>
            </table>
            <div class="menu-list" data-id="0">

            </div>
            <div class="menu-list" id="nemu-new"></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="listtable border-none">
                <tfoot>
                <tr>
                    <td>
                        <label><input type="checkbox" class="checkbox checkall"> 全选</label>
                        <a href="javascript:;" id="addnew"><i class="iconfont icon-roundadd"></i>添加菜单项</a>
                    </td>
                </tr>
                <tr>
                    <td class="btn-group-sm">
                        <input type="submit" class="button" value="提交">
                        <input type="button" class="button button-cancel" value="刷新" onclick="window.location.reload()">
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/x-template" id="J-menu-item-tpl">
        <table cellpadding="0" cellspacing="0" width="100%" class="listtable border-none">
            <tbody>
            <tr>
                <td width="40"><input type="hidden" name="itemlist[#k#][fid]" class="fid" value="0"></td>
                <td width="70"></td>
                <td width="120"><input title="" type="text" name="itemlist[#k#][name]" class="input-text" value="" style="width: 100px;"></td>
                <td><input title="" type="text" name="itemlist[#k#][url]" class="input-text w300" value=""></td>
                <td width="80">
                    <select title="" name="itemlist[#k#][target]" style="width: auto;">
                        <option value="_self">本窗口</option>
                        <option value="_blank">新窗口</option>
                        <option value="_top">顶层框架</option>
                    </select>
                </td>
                <td width="40"><input title="" type="checkbox" name="itemlist[#k#][available]" value="1" checked></td>
            </tr>
            </tbody>
        </table>
    </script>
    <script type="text/javascript">
        var k=0;
        $("#addnew").click(function(e) {
            k--;
            var html = $("#J-menu-item-tpl").html().replace(/#k#/g,k);
            $("#nemu-new").append(html);
        });
        $(".menu-list,.sub-menu").sortable({
            item:'.menu-item',
            connectWith:'.menu-list,.sub-menu',
            update:function(event,ui){
                var fid = $(ui.item).parent().attr('data-id');
                $(ui.item).find(".fid").val(fid);
            }
        });
        $(function () {
            $("[rel=menuicon]").on('click', function () {
                var self = this;
                DSXUI.showImagePicker(function (data) {
                    $(self).attr('src', data.image);
                    $.ajax({
                        type:'POST',
                        url:"{{admin_url('menu/seticon')}}",
                        data:{id:$(self).attr('data-id'), icon:data.image}
                    });
                });
            });
        });
    </script>
@stop
