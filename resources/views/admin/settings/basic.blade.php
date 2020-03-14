@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>系统设置->基本设置</h2>
    </div>
    <div class="content-div">
        <form method="post" action="{{admin_url('settings')}}">
            @csrf
            <table class="dsxui-formtable" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td width="110" class="cell-label">店铺名称:</td>
                    <td width="360" class="cell-input">
                        <input type="text" title="" name="settings[sitename]" class="form-control" value="{{$settings['sitename'] ?? ''}}">
                    </td>
                    <td class="cell-tips">系统名称，将显示在导航条和标题中</td>
                </tr>
                <tr>
                    <td class="cell-label">店铺关键字:</td>
                    <td class="cell-input">
                        <input type="text" title="" name="settings[keywords]" class="form-control" value="{{$settings['keywords'] ?? ''}}">
                    </td>
                    <td class="cell-tips">Keywords 项出现在页面头部的 Meta 标签中，用于记录本页面的关键字，多个关键字间请用半角逗号 "," 隔开</td>
                </tr>
                <tr>
                    <td class="cell-label">店铺描述:</td>
                    <td class="cell-input">
                        <textarea title="" name="settings[description]" class="form-control h80">{{$settings['description'] ?? ''}}</textarea>
                    </td>
                    <td class="cell-tips">Description 出现在页面头部的 Meta 标签中，用于记录本页面的概要与描述</td>
                </tr>
                <tr>
                    <td class="cell-label">备案信息:</td>
                    <td class="cell-input">
                        <input type="text" title="" name="settings[icp]" class="form-control" value="{{$settings['icp'] ?? ''}}">
                    </td>
                    <td class="cell-tips">页面底部可以显示 ICP 备案信息，如果网站已备案，在此输入您的授权码，它将显示在页面底部，如果没有请留空</td>
                </tr>
                <tr>
                    <td class="cell-label">版权信息:</td>
                    <td class="cell-input">
                        <input type="text" title="" name="settings[copyright]" class="form-control" value="{{$settings['copyright'] ?? ''}}">
                    </td>
                    <td class="cell-tips">网站的版权信息，将显示在页面底部</td>
                </tr>
                <tr>
                    <td class="cell-label">统计代码:</td>
                    <td class="cell-input">
                        <textarea title="" name="settings[statcode]" class="form-control h80">{{$settings['statcode'] ?? ''}}</textarea>
                    </td>
                    <td class="cell-tips">用于统计网站访问情况的第三方统计代码，通常为JS代码</td>
                </tr>
                <tr>
                    <td class="cell-label">关闭网站:</td>
                    <td class="cell-input">
                        <div class="input-group">
                            <label><input name="settings[sysclosed]" value="1" type="radio"{{isset($settings['sysclosed']) ? ' checked' : ''}}> 是</label>
                            <label><input name="settings[sysclosed]" value="0" type="radio"{{!isset($settings['sysclosed']) ? ' checked' : ''}}> 否</label>
                        </div>
                    </td>
                    <td class="cell-tips">暂时将网站关闭，其他人无法访问，但不影响管理员访问</td>
                </tr>
                <tr>
                    <td class="cell-label">关闭原因:</td>
                    <td class="cell-input">
                        <textarea title="" name="settings[sysclosedreason]" class="form-control h100">{{$settings['sysclosedreason'] ?? ''}}</textarea>
                    </td>
                    <td class="cell-tips">网站关闭时出现的提示信息</td>
                </tr>
                <tr>
                    <td class="cell-label">地图接口Key:</td>
                    <td class="cell-input">
                        <input type="text" title="" name="settings[amap_client_key]" class="form-control" value="{{$settings['amap_client_key'] ?? ''}}">
                    </td>
                    <td class="cell-tips">高德地图访问接口Key</td>
                </tr>
                <tr>
                    <td class="cell-label">地图服务Key:</td>
                    <td class="cell-input">
                        <input type="text" title="" name="settings[amap_server_key]" class="form-control" value="{{$settings['amap_server_key'] ?? ''}}">
                    </td>
                    <td class="cell-tips">高德地图后台服务Key</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><button class="btn btn-primary w100" type="submit">更新配置</button></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop
