@extends('layouts.seller')

@section('title', '个人资料')

@section('content')
    <div class="console-title">
        <h2>个人资料</h2>
    </div>
    <div class="content-div">
        <form method="post" autocomplete="off" id="Form">
            @csrf
            <table class="dsxui-formtable" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td width="100">您的姓名:</td>
                    <td width="300"><input type="text" class="form-control w300" maxlength="40" placeholder="请输入你的姓名"
                                           name="auth[name]" value="{{$auth->name}}" required></td>
                    <td class="cell-tips">真实姓名，与身份证一致</td>
                </tr>
                <tr>
                    <td>身份证号:</td>
                    <td><input type="text" class="form-control w300" maxlength="18" placeholder="请输入身份证号"
                               name="auth[id_card_no]" value="{{$auth->id_card_no}}" required></td>
                    <td class="cell-tips">你的身份证号码</td>
                </tr>
                <tr>
                    <td>身份证正面:</td>
                    <td>
                        <div class="dsxui-media-input" @click="pickImage('id_card_front')">
                            <input type="hidden" name="auth[id_card_front]" :value="auth.id_card_front">
                            <span class="iconfont icon-add_light"></span>
                            <div class="preview" :style="{'background-image':'url('+auth.id_card_front+')'}"></div>
                        </div>
                    </td>
                    <td class="cell-tips">
                        <img src="{{asset('images/common/id_1.png')}}" width="100" height="60">
                        <p>一张清晰的身份证正面照片<br>支持JPG/JPEG/PNG格式图片，文件大小不超过5MB</p>
                    </td>
                </tr>
                <tr>
                    <td>身份证背面:</td>
                    <td>
                        <div class="dsxui-media-input" @click="pickImage('id_card_back')">
                            <input type="hidden" name="auth[id_card_back]" v-model="auth.id_card_back">
                            <span class="iconfont icon-add_light"></span>
                            <div class="preview" :style="{'background-image':'url('+auth.id_card_back+')'}"></div>
                        </div>
                    </td>
                    <td class="cell-tips">
                        <img src="{{asset('images/common/id_2.png')}}" width="100" height="60">
                        <p>一张清晰的身份证背面照片<br>支持JPG/JPEG/PNG格式图片，文件大小不超过5MB</p>
                    </td>
                </tr>
{{--                <tr>--}}
{{--                    <td>手持身份证:</td>--}}
{{--                    <td>--}}
{{--                        <div class="dsxui-media-input" @click="pickImage('id_card_hand')">--}}
{{--                            <input type="hidden" name="auth[id_card_hand]" v-model="auth.id_card_hand">--}}
{{--                            <span class="iconfont icon-add_light"></span>--}}
{{--                            <div class="preview" :style="{'background-image':'url('+auth.id_card_hand+')'}"></div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                    <td class="cell-tips">--}}
{{--                        <img src="{{asset('images/common/id_3.png')}}" width="100" height="60">--}}
{{--                        <p>一张清晰的手持身份证正面照片<br>支持JPG/JPEG/PNG格式图片，文件大小不超过5MB</p>--}}
{{--                    </td>--}}
{{--                </tr>--}}
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <button type="button" class="btn btn-lg btn-danger w200" @click="submit">提交</button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop

@section('foot')
    <script>var auth = @json($auth);</script>
    <script type="text/javascript">
        var app = new Vue({
            el: '#app',
            data: {
                auth: auth
            },
            methods: {
                pickImage: function (i) {
                    Widget.showImagePicker(function (data) {
                        app.auth[i] = data.image;
                    });
                },
                submit: function () {
                    var auth = this.auth;
                    if (!auth.name) {
                        DSXUI.showToast('请填写姓名');
                        return false;
                    }

                    if (!DSXValidate.isChineseName(auth.name)) {
                        DSXUI.showToast('姓名输入有误');
                        return false;
                    }

                    if (!auth.id_card_no) {
                        DSXUI.showToast('请填写身份证号码');
                        return false;
                    }

                    if (!DSXValidate.isIdCardNo(auth.id_card_no)) {
                        DSXUI.showToast('身份证号码输入错误');
                        return false;
                    }

                    if (!auth.id_card_front) {
                        DSXUI.showToast('请上传身份证正面照');
                        return false;
                    }

                    if (!auth.id_card_back) {
                        DSXUI.showToast('请上传身份证背面照');
                        return false;
                    }

                    // if (!auth.id_card_hand) {
                    //     DSXUI.showToast('请上传手持身份证照');
                    //     return false;
                    // }
                    $("#Form").submit();
                }
            }
        });
    </script>
@stop
