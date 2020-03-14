@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>链接管理</h2>
    </div>
    <div class="content-div">
        <form method="post">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="40">删?</th>
                    <th width="50">图片</th>
                    <th width="400">名称</th>
                    <th width="80">显示顺序</th>
                    <th>网址</th>
                </tr>
                </thead>
                @foreach($categories as $category)
                <tbody id="tbcontent_{{$category['id']}}">
                <tr>
                    <td><input type="checkbox" title="" class="checkmark" name="delete[]" value="{{$category['id']}}" /></td>
                    <td></td>
                    <td><input type="text" title="" class="form-control w200" name="items[{{$category['id']}}][title]" value="{{$category['title']}}" maxlength="10"></td>
                    <td><input type="text" title="" class="form-control w60" name="items[{{$category['id']}}][displayorder]" value="{{$category['displayorder']}}" maxlength="4"></td>
                    <td></td>
                </tr>
                @foreach($category['links'] as $item)
                <tr>
                    <td><input type="checkbox" title="" class="checkmark" name="delete[]" value="{{$item['id']}}" /></td>
                    <td><img src="{{$item['image']}}" width="40" height="40" rel="pickimg" data-id="{{$item['id']}}"></td>
                    <td>
                        <div class="catlog-prefix">
                            <input type="text" title="" class="form-control w200" name="items[{{$item['id']}}][title]" value="{{$item['title']}}" maxlength="10">
                        </div>
                    </td>
                    <td><input type="text" title="" class="form-control w60" name="items[{{$item['id']}}][displayorder]" value="{{$item['displayorder']}}" maxlength="4"></td>
                    <td><input type="text" title="" class="form-control w300" name="items[{{$item['id']}}][url]" value="{{$item['url']}}"></td>
                </tr>
                @endforeach
                </tbody>
                <tbody id="newItem_{{$category['id']}}"></tbody>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div style="padding-left: 30px;">
                            <a rel="addItem" data-id="{{$category['id']}}"><i class="iconfont icon-roundadd"></i><span>添加链接</span></a>
                        </div>
                    </td>
                </tr>
                </tbody>
                @endforeach
                <tbody id="newCategory"></tbody>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3"><a id="addCategory"><i class="iconfont icon-roundadd"></i><span>添加分类</span></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <div class="btn-group-sm">
                            <input type="submit" class="btn btn-primary" value="提交" />
                            <input type="button" class="btn btn-default" value="刷新" data-action="refresh" />
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        var k = 0;
        $(function () {
            $("#addCategory").on('click', function () {
                $("#newCategory").append('<tr>' +
                    '        <td><input type="hidden" name="items['+k+'][type]" value="category" /></td>' +
                    '        <td></td>' +
                    '        <td><input type="text" title="" class="form-control w200" name="items['+k+'][title]" value="新分类" maxlength="10"></td>' +
                    '        <td><input type="text" title="" class="form-control w60" name="items['+k+'][displayorder]" value="0" maxlength="4"></td>' +
                    '        <td></td>' +
                    '    </tr>');
                k--;
            });

            $("[rel=addItem]").on('click', function () {
                var catid = $(this).attr('data-id');
                $("#newItem_"+catid).append('<tr>' +
                    '        <td><input type="hidden" name="items['+k+'][catid]" value="'+catid+'" /></td>\n' +
                    '        <td><input type="hidden" name="items['+k+'][type]" value="item" /></td>\n' +
                    '        <td><div class="catlog-prefix"><input type="text" class="form-control w200" name="items['+k+'][title]" value="新链接" maxlength="10"></div></td>\n' +
                    '        <td><input type="text" class="form-control w60" name="items['+k+'][displayorder]" value="0" maxlength="4"></td>\n' +
                    '        <td><input type="text" class="form-control w300" name="items['+k+'][url]" value=""></td>\n' +
                    '    </tr>');
                k--;
            });

            $("img[rel=pickimg]").on('click', function () {
                var id = $(this).attr('data-id'), self = this;
                Widget.showImagePicker(function (data) {
                    $(self).attr('src', data.thumb);
                    $.post("{{admin_url('link/setimage')}}",{id:id,image:data.image});
                });
            });
        });
    </script>
@stop
