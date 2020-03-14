@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('block/newitem?block_id='.$block_id)}}">
                <span class="btn btn-primary">添加项目</span>
            </a>
            <a href="{{admin_url('block')}}">
                <span class="btn btn-primary">模块列表</span>
            </a>
        </div>
        <h2>内容模块->模块管理->模块内容</h2>
    </div>
    <div class="content-div border-default">
        <form method="post" id="listForm" autocomplete="off">
            @csrf
            <input type="hidden" name="eventType" value="" id="J_eventType">
            <table cellpadding="0" cellspacing="0" width="100%" class="dsxui-listtable border-0">
                <thead>
                <tr>
                    <th width="60"><label><input type="checkbox" class="checkmark" data-action="checkall">删?</label></th>
                    <th width="70">图片</th>
                    <th width="320">标题</th>
                    <th>链接</th>
                    <th width="50">选项</th>
                </tr>
                </thead>
            </table>
            <div class="sortable">
                @foreach($items as $item)
                <table cellspacing="0" cellpadding="0" width="100%" class="dsxui-listtable border-0">
                    <tbody>
                    <tr>
                        <td width="40"><input title="" type="checkbox" class="checkmark" name="delete[]" value="{{$item->id}}"></td>
                        <td width="70"><img src="{{$item['image']}}" width="50" height="50" rel="pickimg" data-id="{{$item->id}}"></td>
                        <td width="320"><input title="" type="text" class="form-control w300" name="items[{{$item->id}}][title]" value="{{$item['title']}}"></td>
                        <td><input title="" type="text" class="form-control w400" name="items[{{$item->id}}][url]" value="{{$item['url']}}"></td>
                        <td width="50"><a href="{{admin_url('block/newitem?block_id='.$block_id.'&id='.$item->id)}}">编辑</a></td>
                    </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="dsxui-listtable border-0">
                <tfoot>
                <tr>
                    <td class="btn-group-sm">
                        <div class="float-right">{!! $pagination !!}</div>
                        <label><input type="checkbox" class="checkmark" data-action="checkall"> 全选</label>
                        <button type="submit" class="btn btn-primary">提交</button>
                        <button type="button" class="btn btn-default" data-action="refresh">刷新</button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            $(".sortable").sortable();
            $("img[rel=pickimg]").on('click', function () {
                var self = this;
                var id = $(this).attr('data-id');
                Widget.showImagePicker(function (data) {
                    $(self).attr('src', data.image);
                    $.ajax({
                        type:'POST',
                        url:"{{admin_url('block/setimage')}}",
                        data:{id:id,image:data.image},
                        dataType:'json',
                        success:function (response) {

                        }
                    });
                });
            });
        });
    </script>
@stop
