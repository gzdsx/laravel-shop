@extends('layouts.admin')

@section('title', '编辑用户')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('user')}}">
                <span class="btn btn-primary">返回列表</span>
            </a>
        </div>
        <h2>用户管理 -> 编辑用户</h2>
    </div>
    <div class="content-div">
        <form method="post" autocomplete="off">
            @csrf
            <table class="dsxui-formtable" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td class="cell-label" width="90">用户名</td>
                    <td class="cell-input" width="300">{{$user['username']}}</td>
                    <td class="cell-tips"> </td>
                </tr>
                <tr>
                    <td class="cell-label">手机号码</td>
                    <td class="cell-input"><input title="" type="text" class="form-control" name="user[mobile]" value="{{$user['mobile']}}"></td>
                    <td class="cell-tips">11位手机号码</td>
                </tr>
                <tr>
                    <td class="cell-label">邮箱地址</td>
                    <td class="cell-input"><input title="" type="text" class="form-control" name="user[email]" value="{{$user['email']}}"></td>
                    <td class="cell-tips">用户邮箱地址</td>
                </tr>
                <tr>
                    <td class="cell-label">登录密码</td>
                    <td class="cell-input"><input title="" type="password" class="form-control" name="user[password]" autocomplete="off"></td>
                    <td class="cell-tips">不修改密码请留空</td>
                </tr>
                <tr>
                    <td class="cell-label">会员等级</td>
                    <td class="cell-input">
                        <select class="form-control custom-select" title="" name="user[gid]">
                            @foreach ($userGroups as $group)
                            <option value="{{$group['gid']}}"{{$group['gid']==$user['gid'] ? ' selected="selected"' : ''}}>{{$group['title']}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="cell-tips"> </td>
                </tr>
                <tr>
                    <td class="cell-label">管理员权限</td>
                    <td class="cell-input">
                        <div class="input-group">
                            <label><input type="radio" name="user[admincp]" value="1"{{$user['admincp'] ? ' checked' : ''}}> 是</label>
                            <label><input type="radio" name="user[admincp]" value="0"{{!$user['admincp'] ? ' checked' : ''}}> 否</label>
                        </div>
                    </td>
                    <td class="cell-tips">是否允许用户登录后台</td>
                </tr>
                <tr>
                    <td class="cell-label">管理员分组</td>
                    <td class="cell-input">
                        <select class="form-control custom-select" title="" name="user[admingid]">
                            @foreach ($systemGroups as $group)
                                <option value="{{$group['gid']}}"{{$group['gid']==$user['admingid'] ? ' selected="selected"' : ''}}>{{$group['title']}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="cell-tips"> </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td> </td>
                    <td><button class="btn btn-primary w100">保存</button></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop
