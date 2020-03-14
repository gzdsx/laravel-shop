@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>菜单管理</h2>
    </div>
    <div class="content-div border-default">
        <form method="post" id="menuForm" autocomplete="off">
            @csrf
            <table cellpadding="0" cellspacing="0" width="100%" class="dsxui-listtable" style="border: 0;">
                <thead>
                <tr>
                    <th width="40">删?</th>
                    <th width="220">名称</th>
                    <th>选项</th>
                </tr>
                </thead>
            </table>
            <div class="menu-list" data-id="0">
                @foreach($items as $item)
                <table cellpadding="0" cellspacing="0" width="100%" class="dsxui-listtable" style="border: 0;">
                    <tbody>
                    <tr>
                        <td width="40"><input title="" type="checkbox" class="checkmark" name="delete[]" value="{{$item->id}}"></td>
                        <td width="220"><input title="" type="text" class="form-control w200" name="items[{{$item->id}}][name]" value="{{$item->name}}"></td>
                        <td><a href="{{admin_url('menu/items?menuid='.$item->id)}}">管理菜单项</a></td>
                    </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
            <div class="menu-div" id="menu-new"></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="dsxui-listtable" style="border: 0;">
                <tfoot>
                <tr>
                    <td>
                        <label><input type="checkbox" class="checkbox checkall"> 全选</label>
                        <label><a href="javascript:;" id="addnew"><i class="iconfont icon-roundaddfill"></i>添加菜单</a></label>
                    </td>
                </tr>
                <tr>
                    <td class="btn-group-sm">
                        <input type="submit" class="btn btn-primary" value="提交">
                        <input type="button" class="btn btn-default" value="刷新" data-action="refresh">
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/x-template" id="J-menu-item-tpl">
        <table cellpadding="0" cellspacing="0" width="100%" class="dsxui-listtable border-0">
            <tbody>
            <tr>
                <td width="40"></td>
                <td width="220"><input title="" type="text" name="items[#k#][name]" class="form-control w200" value=""></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </script>
    <script type="text/javascript">
        var k=0;
        $("#addnew").click(function(e) {
            k--;
            var html = $("#J-menu-item-tpl").html().replace(/#k#/g,k);
            $("#menu-new").append(html);
        });
        $(".menu-list,.menu-div").sortable({
            item:'.nav-item',
            connectWith:'.navigation-top,.sub-top',
            update:function(event,ui){
                var fid = $(ui.item).parent().attr('data-id');
                $(ui.item).children(".fid").val(fid);
            }
        });
    </script>
@stop
