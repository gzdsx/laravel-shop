@extends('layouts.h5')

@section('title', '绑定手机号')

@section('content')
    <div class="weui-cells weui-cells_form padding-0 margin-0" id="app">
        <div class="weui-cell">
            <div class="weui-cell__hd margin-right-10" style="width: 80px;">手机号*</div>
            <div class="weui-cell__bd">
                <p v-if="hasPhone">@{{ hasPhone }}</p>
                <input v-if="!hasPhone" type="tel" class="weui-input" title="" placeholder="请输入手机号" maxlength="11" v-model="phone" required>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd margin-right-10" style="width: 80px;">交易密码*</div>
            <div class="weui-cell__bd">
                <input type="password" class="weui-input" title="" placeholder="请输入交易密码" maxlength="20" v-model="jypassword">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd margin-right-10" style="width: 80px;">验证码*</div>
            <div class="weui-cell__bd">
                <input type="text" class="weui-input" title="" placeholder="请输入验证码" maxlength="6" v-model="code" required>
            </div>
            <div class="weui-cell__ft">
                <div class="weui-btn weui-btn_mini weui-btn_default" v-on:click="getCode()" :class="{'weui-btn_disabled':disabled}">@{{ buttonText }}</div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <div class="fixed-bottom">
        <div class="fixed btn-area">
            <div class="btn-square" style="line-height: 3.2; color: #f00; border-color: #f00;" id="bind">立即绑定</div>
        </div>
    </div>
    <script type="text/javascript">
        var app = new Vue({
            el:'#app',
            data:{
                phone:'{{$user['mobile']}}',
                code:'',
                jypassword:'',
                disabled:false,
                buttonText:'获取验证码',
                hasPhone:'{{$user['mobile']}}'
            },
            methods:{
                getCode:function () {
                    var $this = this;
                    if (this.disabled) return;
                    if (!this.phone)
                    {
                        weui.topTips('请填写手机号码');
                        return false;
                    }

                    if (!DSXValidate.isMobile(this.phone))
                    {
                        weui.topTips('手机号码输入错误');
                        return false;
                    }

                    this.disabled = true;
                    $.ajax({
                        url:'/h5/sms/getcode',
                        data:{phone: this.phone},
                        success:function () {
                            var timer = 60;
                            var t = setInterval(function () {
                                if (timer < 1) {
                                    $this.buttonText = '获取验证码';
                                    $this.disabled = false;
                                    t.clearTimeout();
                                } else {
                                    $this.buttonText = timer+'秒后重试';
                                    timer--;
                                }

                            }, 1000);
                        }
                    });
                }
            }
        });

        $("#bind").on('click', function () {
            if (!app.phone)
            {
                weui.topTips('请填写手机号');
                return false;
            }

            if (!app.code)
            {
                weui.topTips('请填写验证码');
                return false;
            }

            $.ajax({
                url:'/h5/security/bind',
                data:{phone:app.phone, code:app.code,jypassword:app.jypassword},
                type:'POST',
                success:function (response) {
                    if (response.errcode)
                    {
                        weui.toast(response.errmsg);
                    } else {
                        weui.toast('绑定成功',{
                            callback:function () {
                                window.location.href = '/h5/user';
                            }
                        })
                    }
                }
            })
        });
    </script>
@stop
