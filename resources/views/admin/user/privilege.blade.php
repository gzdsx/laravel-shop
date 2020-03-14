@extends('layouts.admin')

@section('title', '编辑用户')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{admin_url('usergroup')}}">
                <span class="btn btn-primary">返回列表</span>
            </a>
        </div>
        <h2>用户管理 -> 编辑权限</h2>
    </div>
    <div class="content-div">
        <form method="post">
            @csrf
            <table class="dsxui-formtable" width="100%" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td class="cell-label" width="60">分组</td>
                    <td class="cell-input">{{$group['title']}}</td>
                </tr>
                <tr>
                    <td class="cell-label">权限</td>
                    <td class="cell-input">
                        @foreach ($privileges as $k=>$v)
                            <label><input type="checkbox" name="privileges[]" value="{{$k}}"{{in_array($k, $group['privileges']) ? ' checked' : ''}}> {{$v}}</label>
                        @endforeach
                    </td>
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
