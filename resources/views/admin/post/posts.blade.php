@extends('layouts.admin')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">后台管理</li>
        <li class="breadcrumb-item">文章管理</li>
        <li class="breadcrumb-item active">文章列表</li>
    </ol>

    <div class="search-container">
        <form method="get" id="searchFrom">
            <div class="row">
                <div class="cell">
                    <div class="label">文章标题:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="title" value="{{$title ?? ''}}"></div>
                </div>
                <div class="cell">
                    <div class="label">用户:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="username" value="{{$username}}"></div>
                </div>
                <div class="cell">
                    <div class="label">目录分类:</div>
                    <div class="field">
                        <select name="catid" class="form-control custom-select w200" title="">
                            <option value="">全部</option>
                            {!! $catlogOptions !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">审核状态:</div>
                    <div class="field">
                        <select name="state" class="form-control custom-select w200" title="">
                            <option value="all">全部</option>
                            @foreach(trans('post.post_states') as $k=>$v)
                            <option value="{{$k}}"@if($state=="$k") selected="selected"@endif>{{$v}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="cell">
                    <div class="label">形式:</div>
                    <div class="field">
                        <select name="type" class="form-control custom-select w200" title="">
                            <option value="">全部</option>
                            @foreach(trans('post.post_types') as $k=>$v)
                            <option value="{{$k}}"@if($type==$k) selected="selected"@endif>{{$v}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="cell">
                    <div class="label">发布时间:</div>
                    <div class="field">
                        <label><input type="text" title="" class="form-control" name="time_begin" value="{{$time_begin ?? ''}}" onclick="WdatePicker()" style="width: 100px;"></label>
                        <label class="seperator"> - </label>
                        <label><input type="text" title="" class="form-control" name="time_end" value="{{$time_end ?? ''}}" onclick="WdatePicker()" style="width: 100px;"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label"></div>
                    <div class="field">
                        <label><button type="submit" class="btn btn-primary">搜索</button></label>
                        <label><button type="reset" class="btn btn-default">重置</button></label>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="content-div">
        <form method="post" id="listForm">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="40" class="center">删?</th>
                    <th width="60">图片</th>
                    <th>标题</th>
                    <th>用户</th>
                    <th width="80">分类</th>
                    <th width="60">形式</th>
                    <th width="80">点击</th>
                    <th width="150">时间</th>
                    <th width="70">状态</th>
                    <th width="45">编辑</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td class="center"><input title="" type="checkbox" class="checkmark aid" name="items[]" value="{{$item['aid']}}"></td>
                    <td><img src="{{image_url($item['image'])}}" width="50" height="50" rel="pickimage" data-id="{{$item['aid']}}"></td>
                    <th>
                        <div style="word-break: break-all; word-wrap: break-word;">
                            <a href="{{post_url($item['aid'])}}" target="_blank">{{$item['title']}}</a>
                        </div>
                    </th>
                    <td>{{$item['user']['username']}}</td>
                    <td>{{$item['catlog']['name']}}</td>
                    <td>{{$item['type_des']}}</td>
                    <td>{{$item['views']}}</td>
                    <td>{{$item['created_at']}}</td>
                    <td>{{$item['state_des']}}</td>
                    <td><a href="{{admin_url('post/newpost?aid='.$item['aid'])}}">编辑</a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="float-right">{!! $pagination !!}</div>
                        <div class="btn-group-sm">
                            <label class="form-check-label"><input type="checkbox" class="checkmark" data-action="checkall"> {{trans('common.selectall')}}</label>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" id="batchdelete">批量删除</button>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" id="batchresolve">审核通过</button>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" id="batchreject">审核不过</button>
                            <button type="button" class="btn btn-default btn-action" disabled="disabled" id="batchmove">批量移动</button>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="moveModal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">移动到分类</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label for="mobile" class="col-form-label">选择目标分类</label>
                            <div class="input-group">
                                <select title="" class="form-control w200" id="moveTarget">
                                    {!! $catlogOptions !!}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnMove">确认</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                if ($(".aid:checked").length > 0)
                {
                    $(".btn-action").enable();
                } else {
                    $(".btn-action").disable();
                }
            });

            $("img[rel=pickimage]").on('click', function () {
                var self = this;
                var aid = $(this).attr('data-id');
                Widget.showImagePicker(function (data) {
                    $(self).attr('src', data.image);
                    $.post("{{admin_url('post/setimage')}}", {aid:aid,image:data.image});
                });
            });

            function getSelectedItems()
            {
                var items = [];
                $(".aid:checked").each(function () {
                    items.push($(this).val());
                });
                return items;
            }

            $("#batchdelete").on('click', function () {
                DSXUI.showConfirm('确认要删除所选文章吗?', function () {
                    $.ajax({
                        url:'{{admin_url('post/batchdelete')}}',
                        type:'POST',
                        beforeSend:DSXUI.showSpinner,
                        data:{items:getSelectedItems()},
                        success:function () {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                DSXUtil.reFresh();
                            }, 500);
                        }
                    });
                });
            });

            $("#batchresolve").on('click', function () {
                $.ajax({
                    url:'{{admin_url('post/batchresolve')}}',
                    type:'POST',
                    beforeSend:DSXUI.showSpinner,
                    data:{items:getSelectedItems()},
                    success:function () {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            DSXUtil.reFresh();
                        }, 500);
                    }
                });
            });

            $("#batchreject").on('click', function () {
                $.ajax({
                    url:'{{admin_url('post/batchreject')}}',
                    type:'POST',
                    beforeSend:DSXUI.showSpinner,
                    data:{items:getSelectedItems()},
                    success:function () {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            DSXUtil.reFresh();
                        }, 500);
                    }
                });
            });

            $("#batchmove").on('click', function () {
                $("#moveModal").modal();
            });

            $("#btnMove").on('click', function () {
                $("#moveModal").modal('hide');
                $.ajax({
                    url:'{{admin_url('post/batchmove')}}',
                    data:{target:$("#moveTarget").val(), items:getSelectedItems()},
                    beforeSend:DSXUI.showSpinner,
                    success:function () {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            DSXUtil.reFresh();
                        }, 500);
                    }
                });
            });
        });
    </script>
@stop
