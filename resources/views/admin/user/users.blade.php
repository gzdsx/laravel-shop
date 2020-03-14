@extends('layouts.admin')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">后台管理</li>
        <li class="breadcrumb-item">用户管理</li>
        <li class="breadcrumb-item active">用户列表</li>
    </ol>

    <div class="search-container">
        <form method="get" id="searchFrom" class="form" role="form">
            <div class="row">
                <div class="cell">
                    <label class="label">用户名:</label>
                    <div class="field">
                        <input type="text" title="" class="form-control w200" name="username" value="{{$username}}">
                    </div>
                </div>
                <div class="cell">
                    <div class="label">手机号:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="mobile" value="{{$mobile}}"></div>
                </div>
                <div class="cell">
                    <div class="label">邮箱:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="email" value="{{$email}}"></div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">会员ID:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="uid" value="{{$uid}}"></div>
                </div>
                <div class="cell">
                    <div class="label">注册日期:</div>
                    <div class="field">
                        <label><input type="text" title="" class="form-control" name="reg_time_begin" onclick="WdatePicker()" value="{{$time_begin}}" style="width: 100px;"></label>
                        <label class="seperator"> - </label>
                        <label><input type="text" title="" class="form-control" name="reg_time_end" onclick="WdatePicker()" value="{{$time_end}}" style="width: 100px;"></label>
                    </div>
                </div>
                <div class="cell">
                    <div class="label">等级:</div>
                    <div class="field">
                        <select class="form-control custom-select w200" title="" name="gid">
                            <option value="">全部</option>
                            @foreach ($userGroups as $group)
                                <option value="{{$group['gid']}}"{{$group['gid']==$gid ? ' selected="selected"' : ''}}>{{$group['title']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label"></div>
                    <div class="field">
                        <button type="submit" class="btn btn-primary" id="btn-search">搜索</button>
                        <button type="button" class="btn btn-default" id="btn-export">重置</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="content-div">
        <form method="post" id="listForm">
            @csrf
            <input type="hidden" id="eventType" name="eventType" value="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="20">选</th>
                    <th width="30">头像</th>
                    <th>姓名</th>
                    <th>手机号</th>
                    <th>电子邮箱</th>
                    <th width="100">会员等级</th>
                    <th width="150">注册日期</th>
                    <th width="80">选项</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr id="user_{{$user['uid']}}">
                    <td><input title="" type="checkbox" class="checkmark" name="users[]" value="{{$user['uid']}}" /></td>
                    <td><img src="{{avatar($uid, 'small')}}" width="30" height="30" style="border-radius:100%;"></td>
                    <th><a>{{$user['username']}}</a></th>
                    <td>{{$user['mobile']}}</td>
                    <td>{{$user['email']}}</td>
                    <td>{{$user['group']['title']}}</td>
                    <td>{{$user['created_at']}}</td>
                    <td>
                        <span><a href="{{admin_url('user/edit?uid='.$user['uid'])}}">编辑</a></span>
                        <span><a href="javascript:;" rel="delete" data-id="{{$user['uid']}}">删除</a></span>
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="12">
                        <div class="float-right">{!! $pagination !!}</div>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" data-action="checkall" /> 全选</label>
                            <button type="button" class="btn btn-default btn-action" id="delete" disabled="disabled">批量删除</button>
                            <button type="button" class="btn btn-default btn-action" id="resolve" disabled="disabled">允许登录</button>
                            <button type="button" class="btn btn-default btn-action" id="reject" disabled="disabled">禁止登录</button>
                            <button type="button" class="btn btn-default" data-action="refresh">刷新</button>
                        </div>
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
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0)
                {
                    $(".btn-action").enable();
                } else {
                    $(".btn-action").disable();
                }
            });

            $("a[rel=delete]").on('click', function () {
                var uid = $(this).attr('data-id');
                DSXUI.showConfirm('确认要删除所选用户吗', function () {
                    $.ajax({
                        type:'POST',
                        url:'{{admin_url('user/delete')}}',
                        data:{users:[uid]},
                        success:function () {
                            $("#user_"+uid).remove();
                        }
                    });
                });
            });

            $("#delete").on('click', function () {
                DSXUI.showConfirm('确认要删除所选用户吗', function () {
                    $("#listForm").ajaxSubmit({
                        url:'{{admin_url('user/delete')}}',
                        beforeSend:DSXUI.showSpinner,
                        success:function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                if (response.errcode){
                                    DSXUI.error(response.errmsg);
                                }else {
                                    DSXUtil.reFresh();
                                }
                            }, 500);
                        }
                    });
                });
            });

            $("#resolve").on('click', function () {
                $("#listForm").ajaxSubmit({
                    url:'{{admin_url('user/batchupdate?state=1')}}',
                    beforeSend:DSXUI.showSpinner,
                    success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            if (response.errcode){
                                DSXUI.error(response.errmsg);
                            }else {
                                DSXUtil.reFresh();
                            }
                        }, 500);
                    }
                });
            });
            $("#reject").on('click', function () {
                $("#listForm").ajaxSubmit({
                    url:'{{admin_url('user/batchupdate?state=-1')}}',
                    beforeSend:DSXUI.showSpinner,
                    success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            if (response.errcode){
                                DSXUI.error(response.errmsg);
                            }else {
                                DSXUtil.reFresh();
                            }
                        }, 500);
                    }
                });
            });
        });
    </script>
@stop
