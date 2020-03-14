@extends('layouts.admin')

@section('content')
    <div class="content-div">
        <form method="post" id="menuForm">
            @csrf
            <input type="hidden" name="menu[fid]" value="{{$fid}}">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                <tbody>
                <tr>
                    <td width="80" class="cell-label">菜单名称</td>
                    <td width="300" class="cell-input"><input title="" type="text" class="form-control" name="menu[name]" value="{{$menu['name']}}" id="menu_name"></td>
                    <td class="cell-tips">一级菜单不超过4个字，二级不超过7个字</td>
                </tr>
                <tr>
                    <td class="cell-label">响应类型</td>
                    <td class="cell-input">
                        <select title="" class="form-control" name="menu[type]" id="menu_type">
                            @foreach($menu_types as $k=>$v)
                            <option value="{{$k}}"@if($k==$menu['type']) selected="selected"@endif>{{$v}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="cell-tips">点击菜单后所执行的操作</td>
                </tr>
                </tbody>
                <tbody id="menu-action"></tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><button type="button" class="btn btn-primary w100" id="submitButton">提交</button></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/x-template" id="menu_tpl_1">
        <tr>
            <td class="cell-label">网页链接</td>
            <td class="cell-input"><input title="" type="text" class="form-control" name="menu[url]" value="{{$menu['url']}}"></td>
            <td class="cell-tips">用户点击菜单可打开链接，不超过1024字节</td>
        </tr>
    </script>
    <script type="text/x-template" id="menu_tpl_2">
        <tr>
            <td class="cell-label">永久素材ID</td>
            <td class="cell-input"><input title="" type="text" class="form-control" name="menu[media_id]" value="{{$menu['media_id']}}"></td>
            <td class="cell-tips">填写永久素材的合法media_id</td>
        </tr>
    </script>
    <script type="text/x-template" id="menu_tpl_3">
        <tr>
            <td class="cell-label">菜单KEY值</td>
            <td class="cell-input"><input title="" type="text" class="form-control" name="menu[key]" value="{{$menu['key']}}"></td>
            <td class="cell-tips">用于消息接口推送，不超过128字节</td>
        </tr>
    </script>
    <script type="text/x-template" id="menu_tpl_4">
        <tr>
            <td class="cell-label">appId</td>
            <td class="cell-input"><input title="" type="text" class="form-control" name="menu[appid]" value="{{$menu['appid']}}"></td>
            <td class="cell-tips">小程序appid</td>
        </tr>
        <tr>
            <td class="cell-label">pagepath</td>
            <td class="cell-input"><input title="" type="text" class="form-control" name="menu[pagepath]" value="{{$menu['pagepath']}}"></td>
            <td class="cell-tips">小程序pagepath</td>
        </tr>
        <tr>
            <td class="cell-label">url</td>
            <td class="cell-input"><input title="" type="text" class="form-control" name="menu[url]" value="{{$menu['url']}}"></td>
            <td class="cell-tips">不支持小程序的老版本客户端将打开本url</td>
        </tr>
    </script>
    <script type="text/javascript">
        function selectMenu(type){
            if(!type) type = 'view';
            if(type === 'view') {
                $("#menu-action").html($("#menu_tpl_1").html());
            }else if(type === 'media_id' || type === 'view_limited') {
                $("#menu-action").html($("#menu_tpl_2").html());
            }else if (type === 'miniprogram'){
                $("#menu-action").html($("#menu_tpl_4").html());
            }else {
                $("#menu-action").html($("#menu_tpl_3").html());
            }
        }
        selectMenu('{{$menu['type']}}');
        $("#menu_type").change(function(e) {
            selectMenu($(this).val());
        });
        $(function () {
            $("#submitButton").on('click', function () {
                var name = $.trim($("#menu_name").val());
                if (!name) {
                    DSXUI.showToast('请填写菜单名称');
                    return false;
                }

                $("#menuForm").ajaxSubmit({
                    dataType:'json',
                    success:function (response) {
                        if (response.errcode){
                            DSXUI.showToast(response.errmsg);
                        }else {
                            if (window.parent.afterMenuSave){
                                window.parent.afterMenuSave(response);
                            }
                        }
                    }
                });
            });
        })
    </script>
@stop
