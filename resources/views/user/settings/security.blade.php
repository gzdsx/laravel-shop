@extends('layouts.user')

@section('title', '账户安全')

@section('content')
    <div class="console-title">
        <h2>账户安全</h2>
    </div>
    <div id="userinfo-table-wrap">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="formtable">
            <tbody>
            <tr>
                <td width="100">用户名</td>
                <td width="340">{{$user['username']}}</td>
                <td> </td>
            </tr>
            <tr>
                <td width="100">账号ID</td>
                <td width="340">{{$user['uid']}}</td>
                <td> </td>
            </tr>
            <tr>
                <td>手　机</td>
                @if($user['mobile'])
                    <td>{{$user['mobile']}}</td>
                    <td><a class="a-bind-link" id="a-bind-mobile" href="javascript:;">更换手机号</a></td>
                @else
                    <td>没有绑定手机号</td>
                    <td><a class="a-bind-link" id="a-bind-mobile" href="javascript:;">绑定手机号</a></td>
                @endif
            </tr>
            <tr>
                <td>邮　箱</td>
                @if($user['email'])
                    <td>{{$user['email']}}</td>
                    <td><a class="a-bind-link" id="a-bind-email" href="javascript:;">更换邮箱</a></td>
                @else
                    <td>没有绑定邮箱</td>
                    <td><a class="a-bind-link" id="a-bind-email" href="javascript:;">定新邮箱</a></td>
                @endif
            </tr>
            <tr>
                <td>密　码</td>
                <td>******</td>
                <td><a class="a-bind-link" id="a-modi-password" href="javascript:;">修改密码</a></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="mobileModal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">绑定手机号</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{url('/user/bindmobile')}}" role="form" id="FormMobile">
                            @csrf
                            <div class="form-group">
                                <label for="mobile" class="col-form-label">输入手机号</label>
                                <div class="input-group">
                                    <input type="text" title="" class="form-control" name="mobile" maxlength="11" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">输入验证码</label>
                                <div class="input-group" style="height: 28px;">
                                    <input type="text" title="" class="form-control" name="captcha" maxlength="4" required>
                                    <div class="input-group-append">
                                        <img src="{{Captcha::src()}}" onclick="$(this).attr('src', '{{Captcha::src()}}?'+Math.random())" style="height: 33px; display: block; cursor: pointer;">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnBindMobile">确认绑定</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="emailModal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">绑定邮箱</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{url('/user/bindemail')}}" role="form" id="FormEmail">
                            @csrf
                            <div class="form-group">
                                <label for="mobile" class="col-form-label">输入邮箱地址</label>
                                <div class="input-group">
                                    <input type="email" title="" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">输入验证码</label>
                                <div class="input-group" style="height: 28px;">
                                    <input type="text" title="" class="form-control" name="captcha" maxlength="4" required>
                                    <div class="input-group-append">
                                        <img src="{{Captcha::src()}}" onclick="$(this).attr('src', '{{Captcha::src()}}?'+Math.random())" style="height: 33px; display: block; cursor: pointer;">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="btnBindEmail">确认绑定</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="passModal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">修改密码</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" action="{{url('/user/resetpass')}}" role="form" id="FormPass" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label class="col-form-label">请输入原密码</label>
                                <div class="input-group">
                                    <input type="password" title="" class="form-control" name="oldpassword" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">请输入新密码</label>
                                <div class="input-group">
                                    <input type="password" title="" class="form-control" name="newpassword" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">输入验证码</label>
                                <div class="input-group" style="height: 28px;">
                                    <input type="text" title="" class="form-control" name="captcha" maxlength="4" required>
                                    <div class="input-group-append">
                                        <img src="{{Captcha::src()}}" onclick="$(this).attr('src', '{{Captcha::src()}}?'+Math.random())" style="height: 33px; display: block; cursor: pointer;">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="resetPassword">确认修改</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/dialog.js')}}"></script>
    <script type="text/javascript">
        $("#a-bind-mobile").click(function(e) {
            $("#mobileModal").modal();
            $("#btnBindMobile").on('click', function () {
                var form = $("#FormMobile");
                var mobile = $.trim(form.find("[name=mobile]").val());
                var captcha = $.trim(form.find("[name=captcha]").val());
                if (!mobile) {
                    DSXUI.showToast('{{trans('user.please input mobile')}}');
                    return false;
                }

                if (!DSXValidate.isMobile(mobile)) {
                    DSXUI.showToast('{{trans('user.mobile input incorrect')}}');
                    return false;
                }

                if (captcha.length !== 4) {
                    DSXUI.showToast('{{trans('user.please input captcha')}}');
                    return false;
                }

                form.ajaxSubmit({
                    success:function (response) {
                        if (response.errcode)
                        {
                            DSXUI.showToast(response.errmsg);
                        } else {
                            DSXUI.showToast('手机号码绑定成功', 1500, DSXUtil.reFresh);
                        }
                    },
                    error:function (xhr) {
                        console.log($.parseJSON(xhr.responseText));
                    }
                })
            });
        });
        $("#a-bind-email").click(function(e) {
            $("#emailModal").modal();
            $("#btnBindEmail").on('click', function () {
                var form = $("#FormEmail");
                var email = $.trim(form.find("[name=email]").val());
                var captcha = $.trim(form.find("[name=captcha]").val());
                if (!email) {
                    DSXUI.showToast('{{trans('user.please input email')}}');
                    return false;
                }

                if (!DSXValidate.isEmail(email)) {
                    DSXUI.showToast('{{trans('user.email input incorrect')}}');
                    return false;
                }

                if (captcha.length !== 4) {
                    DSXUI.showToast('{{trans('user.please input captcha')}}');
                    return false;
                }

                form.ajaxSubmit({
                    success:function (response) {
                        if (response.errcode)
                        {
                            DSXUI.showToast(response.errmsg);
                        } else {
                            DSXUI.showToast('邮箱地址绑定成功', 1500, DSXUtil.reFresh);
                        }
                    }
                });
            });
        });
        $("#a-modi-password").click(function(e) {
            $("#passModal").modal();
            $("#resetPassword").on('click', function () {
                var form = $("#FormPass");
                var oldpassword = $.trim(form.find("[name=oldpassword]").val());
                var newpassword = $.trim(form.find("[name=newpassword]").val());
                var captcha = $.trim(form.find("[name=captcha]").val());
                if (!oldpassword) {
                    DSXUI.showToast('{{trans('user.please input old password')}}');
                    return false;
                }

                if (!newpassword) {
                    DSXUI.showToast('{{trans('user.please input new password')}}');
                    return false;
                }

                if (captcha.length !== 4) {
                    DSXUI.showToast('{{trans('user.please input captcha')}}');
                    return false;
                }

                form.ajaxSubmit({
                    success:function (response) {
                        if (response.errcode)
                        {
                            DSXUI.showToast(response.errmsg);
                        } else {
                            DSXUI.showToast('密码修改成功', 1500, DSXUtil.reFresh);
                        }
                    }
                });
            });
        });
    </script>
@stop
