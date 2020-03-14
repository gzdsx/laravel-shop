@extends('layouts.admin')

@section('title', '商品分类管理')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('item/catlog/newcatlog')}}" role="button">
                <span class="btn btn-primary">添加新分类</span>
            </a>
        </div>
        <h2>商品管理 > 分类管理</h2>
    </div>
    <div class="content-div">
        <form method="post">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="60">ID</th>
                    <th width="60" class="align-center">图标</th>
                    <th>分类名称</th>
                    <th width="100">标识</th>
                    <th width="80">显示顺序</th>
                    <th width="50" class="align-center">可选</th>
                    <th width="50" class="align-center">可用</th>
                    <th width="140">选项</th>
                </tr>
                </thead>
                @foreach($catlogs as $catlog)
                <tbody id="catlog_{{$catlog['catid']}}">
                <tr>
                    <td width="60">{{$catlog['catid']}}</td>
                    <td width="60" class="align-center"><img src="{{$catlog['icon']}}" width="30" height="30" rel="pickimage" data-id="{{$catlog['catid']}}"></td>
                    <td><input type="text" title="" class="form-control w200" name="catlogs[{{$catlog['catid']}}][name]" value="{{$catlog['name']}}" maxlength="10" style="font-weight:bold;"></td>
                    <td width="100"><input type="text" title="" class="form-control w200"  name="catlogs[{{$catlog['catid']}}][identifier]" value="{{$catlog['identifier']}}"></td>
                    <td width="80"><input type="number" title="" class="form-control w60"  name="catlogs[{{$catlog['catid']}}][displayorder]" value="{{$catlog['displayorder']}}"></td>
                    <td width="50" class="align-center"><input type="checkbox" title="" name="catlogs[{{$catlog['catid']}}][enable]" value="1"@if($catlog['enable']) checked="checked"@endif></td>
                    <td width="50" class="align-center"><input type="checkbox" title="" name="catlogs[{{$catlog['catid']}}][available]" value="1"@if($catlog['available']) checked="checked"@endif></td>
                    <td width="40">
                        <a href="{{admin_url('item/catlog/props?catid='.$catlog['catid'])}}">分类属性</a>
                        <a href="{{admin_url('item/catlog/newcatlog?catid='.$catlog['catid'])}}">编辑</a>
                        <a href="{{admin_url('item/catlog/delete?catid='.$catlog['catid'])}}">删除</a>
                    </td>
                </tr>
                </tbody>
                    @foreach($catlog->childs as $child)
                        <tbody id="catlog_{{$child['catid']}}">
                        <tr>
                            <td width="60">{{$child['catid']}}</td>
                            <td width="60" class="align-center"><img src="{{$child['icon']}}" width="30" height="30" rel="pickimage" data-id="{{$child['catid']}}"></td>
                            <td>
                                <div class="catlog-prefix">
                                    <input type="text" title="" class="form-control w200" name="catlogs[{{$child['catid']}}][name]" value="{{$child['name']}}" maxlength="10">
                                </div>
                            </td>
                            <td width="100"><input type="text" title="" class="form-control w200"  name="catlogs[{{$child['catid']}}][identifier]" value="{{$child['identifier']}}"></td>
                            <td width="80"><input type="number" title="" class="form-control w60"  name="catlogs[{{$child['catid']}}][displayorder]" value="{{$child['displayorder']}}"></td>
                            <td width="50" class="align-center"><input type="checkbox" title="" name="catlogs[{{$child['catid']}}][enable]" value="1"@if($child['enable']) checked="checked"@endif></td>
                            <td width="50" class="align-center"><input type="checkbox" title="" name="catlogs[{{$child['catid']}}][available]" value="1"@if($child['available']) checked="checked"@endif></td>
                            <td width="40">
                                <a href="{{admin_url('item/catlog/props?catid='.$child['catid'])}}">分类属性</a>
                                <a href="{{admin_url('item/catlog/newcatlog?catid='.$child['catid'])}}">编辑</a>
                                <a href="{{admin_url('item/catlog/delete?catid='.$child['catid'])}}">删除</a>
                            </td>
                        </tr>
                        </tbody>
                        @foreach($child->childs as $sub)
                            <tbody id="catlog_{{$sub['catid']}}">
                            <tr>
                                <td width="60">{{$sub['catid']}}</td>
                                <td width="60" class="align-center">
                                    <img src="{{$sub['icon']}}" width="30" height="30" rel="pickimage" data-id="{{$sub['catid']}}">
                                </td>
                                <td>
                                    <div class="catlog-prefix">
                                        <div class="catlog-prefix">
                                            <input type="text" title="" class="form-control w200" name="catloglist[{{$sub['catid']}}][name]" value="{{$sub['name']}}" maxlength="10">
                                        </div>
                                    </div>
                                </td>
                                <td width="100"><input type="text" title="" class="form-control w200"  name="catlogs[{{$sub['catid']}}][identifier]" value="{{$sub['identifier']}}"></td>
                                <td width="80"><input type="number" title="" class="form-control w60"  name="catlogs[{{$sub['catid']}}][displayorder]" value="{{$sub['displayorder']}}"></td>
                                <td width="50" class="align-center"><input title="" type="checkbox" name="catlogs[{{$sub['catid']}}][enable]" value="1"@if($sub['enable']) checked="checked"@endif></td>
                                <td width="50" class="align-center"><input title="" type="checkbox" name="catlogs[{{$sub['catid']}}][available]" value="1"@if($sub['available']) checked="checked"@endif></td>
                                <td width="40">
                                    <a href="{{admin_url('item/catlog/props?catid='.$sub['catid'])}}">分类属性</a>
                                    <a href="{{admin_url('item/catlog/newcatlog?catid='.$sub['catid'])}}">编辑</a>
                                    <a href="{{admin_url('item/catlog/delete?catid='.$sub['catid'])}}">删除</a>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    @endforeach
                @endforeach
                <tfoot>
                <tr>
                    <td colspan="10" class="btn-group-sm">
                        <button type="submit" class="btn btn-primary">保存</button>
                        <button type="button" class="btn btn-default" data-action="refresh">刷新</button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $(function () {
            $("img[rel=pickimage]").on('click', function () {
                var self = this;
                var catid = $(this).attr('data-id');
                Widget.showImagePicker(function (data) {
                    $(self).attr('src', data.image);
                    $.post("{{admin_url('item/catlog/seticon')}}", {catid:catid,icon:data.image});
                });
            });
        });
    </script>
@stop
