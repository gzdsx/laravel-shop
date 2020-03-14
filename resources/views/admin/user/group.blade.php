@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <a href="{{admin_url('user')}}" class="float-right" role="button">
            <span class="btn btn-primary">用户列表</span>
        </a>
        <h2>用户分组管理</h2>
    </div>
    <div class="content-div">
        <form method="post" autocomplete="off">
            @csrf
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dsxui-listtable">
                <thead>
                <tr>
                    <th width="40" class="center">删?</th>
                    <th width="50">GID</th>
                    <th>组名称</th>
                    <th width="140">积分下限</th>
                    <th width="140">积分上限</th>
                    <th width="110">组权限</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th colspan="6">管理组</th>
                </tr>
                @foreach($systemGroups as $group)
                    <tr>
                        <td><input type="checkbox" class="checkbox" title="" disabled="disabled"/></td>
                        <td>{{$group['gid']}}</td>
                        <td colspan="3"><input type="text" title="" class="form-control w100"
                                               name="groups[{{$group['gid']}}][title]" value="{{$group['title']}}"
                                               maxlength="10"></td>
                        <td><a href="{{admin_url('usergroup/privilege?gid='.$group['gid'])}}">权限管理</a></td>
                    </tr>
                @endforeach
                </tbody>
                <tbody>
                <tr>
                    <th colspan="6">用户组</th>
                </tr>
                @foreach($userGroups as $group)
                    <tr>
                        <td><input type="checkbox" class="checkbox" title="" name="delete[]" value="{{$group['gid']}}"/>
                        </td>
                        <td>{{$group['gid']}}</td>
                        <td><input type="text" title="" class="form-control w100"
                                   name="groups[{{$group['gid']}}][title]" value="{{$group['title']}}" maxlength="10">
                        </td>
                        <td><input type="text" title="" class="form-control w100"
                                   name="groups[{{$group['gid']}}][creditslower]" value="{{$group['creditslower']}}"
                                   maxlength="10"></td>
                        <td><input type="text" title="" class="form-control w100"
                                   name="groups[{{$group['gid']}}][creditshigher]" value="{{$group['creditshigher']}}"
                                   maxlength="10"></td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
                <tbody id="newgroups"></tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <a href="javascript:;" id="addgroup">
                            <span class="iconfont icon-roundadd"></span>
                            添加新分组
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="10" class="btn-group-sm">
                        <input type="submit" class="btn btn-primary" value="提交"/>
                        <input type="button" class="btn btn-default" value="刷新" data-action="refresh"/>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/html" id="rowtpl">
        <tr>
            <td></td>
            <td><input type="hidden" name="groups[nkey][type]" value="user"></td>
            <td><input type="text" title="" class="form-control w100" name="groups[nkey][title]" value=""
                       maxlength="10"></td>
            <td><input type="text" title="" class="form-control w100" name="groups[nkey][creditslower]" value=""
                       maxlength="10"></td>
            <td><input type="text" title="" class="form-control w100" name="groups[nkey][creditshigher]" value=""
                       maxlength="10"></td>
            <td><input type="text" title="" class="form-control w100" name="groups[nkey][commission_rate]" value=""
                       maxlength="10"></td>
        </tr>
    </script>
    <script type="text/javascript">
        var nkey = 0;
        $("#addgroup").click(function () {
            nkey--;
            $("#newgroups").append($("#rowtpl").html().replace(/nkey/g, nkey));
        });
    </script>
@stop
