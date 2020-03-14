@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <label><input type="button" class="btn btn-primary" value="应用菜单" onclick="apply()" /></label>
            <label><input type="button" class="btn btn-primary" value="删除菜单" onclick="remove()" /></label>
        </div>
        <h2>微信自定义菜单设置</h2>
    </div>
    <div class="content-div border-default">
        <form method="post">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable border-0">
                <thead>
                <tr>
                    <th width="40" class="center">删?</th>
                    <th width="40">ID</th>
                    <th width="500">菜单名称</th>
                    <th width="200">菜单类型</th>
                    <th>选项</th>
                </tr>
                </thead>
            </table>
            <div id="menu-item-list">
                @foreach($menus as $menu)
                <div class="menu-item">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable border-0">
                        <tbody>
                        <tr>
                            <td width="40"><input title="" type="checkbox" class="checkmark" name="delete[]" value="{{$menu['id']}}"></td>
                            <td width="40">{{$menu['id']}}</td>
                            <td width="500">
                                <label>
                                    <input title="" type="text" class="form-control w200" name="menus[{{$menu['id']}}][name]" value="{{$menu['name']}}" maxlength="10" style="font-weight:bold;">
                                </label>
                                <a onclick="showDialog({{$menu['id']}}, 0)">+添加子分类</a>
                            </td>
                            <td width="200">{{$menu['type_des']}}</td>
                            <td><a onclick="showDialog(0, {{$menu['id']}})">编辑</a></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="menu-sub-list">
                        @foreach($menu->childs as $child)
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable sub-item border-0">
                            <tbody>
                            <tr>
                                <td width="40"><input title="" type="checkbox" class="checkmark" name="delete[]" value="{{$child['id']}}" /></td>
                                <td width="40">{{$child['id']}}</td>
                                <td width="500">
                                    <div class="cat-level cat-level-2"></div>
                                    <input title="" type="text" class="form-control w200" name="menus[{{$child['id']}}][name]" value="{{$child['name']}}" maxlength="10">
                                </td>
                                <td width="200">{{$child['type_des']}}</td>
                                <td><a onclick="showDialog({{$menu['id']}}, {{$child['id']}})">编辑</a></td>
                            </tr>
                            </tbody>
                        </table>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable border-0">
                <tfoot>
                <tr>
                    <td>
                        <label><input type="checkbox" data-action="checkall" /> 全选</label>
                        <a onclick="showDialog(0, 0)" style="margin-left:20px;"><i class="iconfont icon-roundadd"></i>添加菜单</a>
                        <p class="tips">提示:提交后选中项将被删除，微信菜单一级菜单最多3个，二级菜单最多5个，一级菜单最多4个字，二级菜单最多7各字</p>
                    </td>
                </tr>
                <tr>
                    <td class="btn-group-sm">
                        <input type="submit" class="btn btn-primary" value="提交" />
                        <input type="button" class="btn btn-default" value="刷新" data-action="refresh" />
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $("#menu-item-list").sortable({item:'.menu-item'});
        $(".menu-sub-list").sortable({item:'.sub-item'});

        function showDialog(fid, id) {
            if (!id) id = 0;
            var url = '{{admin_url('wechat/menu/newmenu')}}?fid='+fid+'&id='+id;
            var content = '<iframe src="'+url+'" style="width: 100%; height: 400px;" frameborder="0" scrolling="no"></iframe>';
            DSXUI.dialog({
                title: id ? '编辑菜单' :'添加菜单',
                content:content,
                showFooter:false,
                style:{
                    width: '750px',
                    maxWidth: '750px'
                },
                afterShow:function (dlg) {
                    window.afterMenuSave = function () {
                        dlg.close();
                        DSXUtil.reFresh();
                    }
                }
            });
        }

        function apply(){
            DSXUI.showConfirm('应用成功后，微信公众号现有的自定义菜单将会被替换', function () {
                $.ajax({
                    url:'{{admin_url('wechat/menu/apply')}}',
                    beforeSend:DSXUI.showSpinner,
                    success: function(response){
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            //alert(JSON.stringify(response));
                            if (response.errcode){
                                DSXUI.showToast('菜单应用失败');
                            }else {
                                DSXUI.showToast('菜单应用成功');
                            }
                        }, 500);
                    }
                });
            });
        }

        function remove(){
            DSXUI.showConfirm('确认要删除微信菜单吗?', function () {
                $.ajax({
                    url:'{{admin_url('wechat/menu/remove')}}',
                    dataType:'json',
                    beforeSend:DSXUI.showSpinner,
                    success:function () {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            if (response.errcode){
                                DSXUI.showToast(response.errmsg);
                            }else {
                                DSXUI.showToast('菜单删除成功');
                            }
                        }, 500);
                    }
                })
            });
        }
    </script>
@stop
