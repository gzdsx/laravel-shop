@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>系统设置->注册设置</h2>
    </div>
    <div class="content-div">
        <form method="post" action="{{admin_url('settings')}}">
            {{csrf_field()}}
            <table width="100%" cellspacing="0" cellpadding="0" class="dsxui-formtable">
                <tbody>
                <tr>
                    <td width="110" class="cell-label">开放用户注册:</td>
                    <td width="360" class="cell-input">
                        <div class="input-group">
                            <label><input type="radio" value="1" name="settings[regallowed]"{{isset($settings['regallowed']) ? ' checked' : ''}}> 是</label>
                            <label><input type="radio" value="0" name="settings[regallowed]"{{!isset($settings['regallowed']) ? ' checked' : ''}}> 否</label>
                        </div>
                    </td>
                    <td class="cell-tips">设置是否允许游客注册成为网站会员。</td>
                </tr>
                <tr>
                    <td class="cell-label">新用户注册验证:</td>
                    <td class="cell-input">
                        <select title="" class="form-control custom-select" name="settings[regverify]">
                            <option value="0"{{$settings['regverify']=='0' ? ' selected' : ''}}>无</option>
                            <option value="1"{{$settings['regverify']=='1' ? ' selected' : ''}}>Email验证</option>
                            <option value="2"{{$settings['regverify']=='2' ? ' selected' : ''}}>人工审核</option>
                        </select>
                    </td>
                    <td class="cell-tips">
                        选择“无”用户可直接注册成功；选择“Email 验证”将向用户注册 Email 发送一封验证邮件以确认邮箱的有效性；
                        选择“人工审核”将由管理员人工逐个确定是否允许新用户注册
                    </td>
                </tr>
                <tr>
                    <td class="cell-label">发送欢迎信息:</td>
                    <td class="cell-input">
                        <div class="input-group">
                            <label>
                                <input title="" type="radio" value="0" name="settings[wellcomemsg]"{{$settings['wellcomemsg']=='0' ? ' checked' : ''}}> 不发送
                            </label>
                            <label>
                                <input title="" type="radio" value="1" name="settings[wellcomemsg]"{{$settings['wellcomemsg']=='1' ? ' checked' : ''}}> 发送欢迎短信息
                            </label>
                            <label>
                                <input title="" type="radio" value="2" name="settings[wellcomemsg]"{{$settings['wellcomemsg']=='2' ? ' checked' : ''}}> 发送欢迎Email
                            </label>
                        </div>
                    </td>
                    <td class="cell-tips">可选择是否自动向新注册用户发送一条欢迎信息</td>
                </tr>
                <tr>
                    <td class="cell-label">显示许可协议:</td>
                    <td class="cell-input">
                        <div class="input-group">
                            <label><input type="radio" value="1" name="settings[sysrules]"{{$settings['sysrules'] ? ' checked' : ''}}> 是</label>
                            <label><input type="radio" value="0" name="settings[sysrules]"{{!$settings['sysrules'] ? ' checked' : ''}}> 否</label>
                        </div>
                    </td>
                    <td class="cell-tips">新用户注册时显示许可协议</td>
                </tr>
                <tr>
                    <td class="cell-label">许可协议内容:</td>
                    <td class="cell-input">
                        <textarea title="" class="form-control h200" name="settings[sysrulestxt]">{{$settings['sysrulestxt'] ?? ''}}</textarea>
                    </td>
                    <td class="cell-tips">注册许可协议的详细内容</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><button type="submit" class="btn btn-primary w100">更新配置</button></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop
